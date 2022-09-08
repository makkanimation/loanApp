<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateLoanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('loan_status')->insert([
            'slug' => 'approved',
            'display_name' => 'Loan Approved',
            'status' => 1,
        ]);
        \DB::table('loan_status')->insert([
            'slug' => 'rejected',
            'display_name' => 'Loan Rejected',
            'status' => 1,
        ]);
        \DB::table('loan_status')->insert([
            'slug' => 'pending',
            'display_name' => 'Loan request pending',
            'status' => 1,
        ]);
        \DB::table('loan_status')->insert([
            'slug' => 'on_hold',
            'display_name' => 'Loan On Hold',
            'status' => 1,
        ]);
    }
}
