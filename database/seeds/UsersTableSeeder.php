<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Create a admin user.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Brandon',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }
}
