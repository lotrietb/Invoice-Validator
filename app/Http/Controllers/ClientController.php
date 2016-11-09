<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;

class ClientController extends Controller
{
	//dd($request->ip());
    public function save(Request $request)
    {
    	$this->validate($request, [
	        'name' => 'required',
	        'ip_address_start' => 'required|ip',
	        'ip_address_end' => 'ip',
	        'password' => 'required',
	    ]);

    	$client = new Client(
    		array(
    			'name' => $request->name, 
    			'description' => $request->description, 
    			'ip_address_start' => $request->ip_address_start, 
    			'ip_address_end' => (empty($request->ip_address_end))? '':$request->ip_address_end, 
    			'uuid' => $this->generateuuid(), 
    			'password' => $request->password
    		)
    	);

    	$client->save();	
    	return redirect('home');
    }
    public function update($id, Request $request)
    {
    	$this->validate($request, [
	        'name' => 'required',
	        'ip_address_start' => 'required|ip',
	        'ip_address_end' => 'ip',
	        'password' => 'required',
	    ]);

		$client = Client::find($id);
    	$client->name = $request->name;
    	$client->description = $request->description;
    	$client->ip_address_start = $request->ip_address_start;
    	$client->ip_address_end = $request->ip_address_end ?: NULL;

    	$client->save();
    	return redirect('home');
    }

    public function edit ($id = false, Request $request) {
    	$client = Client::find($id);
    	if(!empty($client))	{
			return view('clients/edit', compact('client'));
        } else {
        	return redirect('/');
        }
    }

    public function requests ($id, Request $request) {
        $client_requests = Client::find($id)->requests()->paginate(15);

        return view('clients.requests', compact('client_requests'));
    }

    private function generateuuid() {
    	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	        // 32 bits for "time_low"
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

	        // 16 bits for "time_mid"
	        mt_rand( 0, 0xffff ),

	        // 16 bits for "time_hi_and_version",
	        // four most significant bits holds version number 4
	        mt_rand( 0, 0x0fff ) | 0x4000,

	        // 16 bits, 8 bits for "clk_seq_hi_res",
	        // 8 bits for "clk_seq_low",
	        // two most significant bits holds zero and one for variant DCE1.1
	        mt_rand( 0, 0x3fff ) | 0x8000,

	        // 48 bits for "node"
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	    );
	}
}
