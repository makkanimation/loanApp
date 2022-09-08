<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Admin',
            'status' => 1,
        ]);
        \DB::table('roles')->insert([
            'name' => 'client',
            'display_name' => 'Client',
            'status' => 1,
        ]);
    }
}
