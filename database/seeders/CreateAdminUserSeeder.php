<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleadmin = \DB::table('roles')->where('name', 'admin')->first();
        if($roleadmin){
            \DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role_id' => $roleadmin->id
            ]);
        }
    }
}
