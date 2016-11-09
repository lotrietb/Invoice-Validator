<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JsonSchema;
use App\ClientRequest;

class ValidateController extends Controller
{
	private $current_request = false;
    private $authenticated_client = false;
	public function __construct(Request $request)
	{
		$this->current_request = $request;
        $this->authenticate();
		$this->is_valid_request();
	}
    public function index(Request $request)
    {
    	$data = json_decode($request->getContent());

    	$schema = json_decode(file_get_contents(url('/json/schema.json')));

		// Validate
		$validator = new JsonSchema\Validator;
		$validator->check($data, $schema);

		if ($validator->isValid()) {
		    $this->generate_response([
    			'status' => 'success',
    			'messages' => 'The supplied json is valid'
    		]);
		} else {
		    $this->generate_response([
    			'status' => 'error',
    			'code' => 'VALIDATION_FAILED',
    			'errors' => $validator->getErrors()
    		]);
		}
		
    }

    public function authenticate()
    {    	
    	$user_ip = $this->current_request->ip();
    	$user_pass = $this->current_request->pass;

    	if ($user_pass) {
    		$clients = \DB::table('clients')
	                     ->select('*')
	                     ->where(\DB::raw('md5(password)'), '=', $user_pass)
	                     ->get();

	        if ($clients->isEmpty()) {
	        	$this->generate_response(['status' => 'error', 'description' => 'Invalid user.Password is incorrect'], false);
	        } else if (!empty($clients[0])) {
                if (is_null($clients[0]->ip_address_end) && $user_ip !== $clients[0]->ip_address_start) {//not checking against range
                    $this->generate_response(['status' => 'error', 'description' => 'Invalid user. Users IP does not match!'], false);
                } else {
                    $start = ip2long($clients[0]->ip_address_start);
                    $end = ip2long($clients[0]->ip_address_end);
                    $user_ip = ip2long($user_ip);

                    if ($user_ip > $end || $user_ip < $start) {
                        $this->generate_response(['status' => 'error', 'description' => 'Invalid user. User IP not in range!'], false);
                    }
                }
                $this->authenticated_client = $clients[0];
            }
    	}
    }

    public function is_valid_request() 
    {        
        $data = json_decode($this->current_request->getContent());
        
        if(is_null($data)) { //not a valid JSON object
            $this->generate_response(['status' => 'error', 'description' => 'Invalid json']);
        }
    }

    public function generate_response($response, $save_request = true) 
    {
        if ($save_request) {
            $req = new ClientRequest([
                'request_string' => $this->current_request->getContent(),
                'response_string' => json_encode($response),
                'response_status' => $response['status']
            ]);
            $req->client_id = $this->authenticated_client->id;
            $req->save();
        }

		header('Content-Type: application/json');
    	echo json_encode($response);
    	exit();
    }
}
