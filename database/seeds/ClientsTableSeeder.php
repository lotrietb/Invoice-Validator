<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Create a admin user.
     *
     * @return void
     */
    public function run()
    {
         DB::table('clients')->insert([
            'uuid' => 'd8176563-a708-4b84-8109-7e66554fe03e',
            'password' => bcrypt('admin'),
            'name' => 'Test Client',
            'description' => 'This is a test client added using the seeder.',
            'ip_address_start' => '196.132.211.71',
            'api_token' => str_random(60),
        ]);
    }
}
