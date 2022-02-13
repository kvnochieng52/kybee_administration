<?php

use Illuminate\Database\Seeder;

class LoanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loan_statuses')->insert([
            [
                'loan_status_name' => 'Pending Approval',
                'visible' => 1,
                'description' => 'Loan is pending Approval',
                'color_code' => '#89CFF0',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'loan_status_name' => 'Approved',
                'visible' => 1,
                'description' => 'Loan is Approved. will be dispursed in your Account ASAP',
                'color_code' => '#89CFF0',
                'created_by' => 1,
                'updated_by' => 1,
            ],

            [
                'loan_status_name' => 'Declined',
                'visible' => 1,
                'description' => 'Loan is Declined.',
                'color_code' => '#89CFF0',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'loan_status_name' => 'Sent',
                'visible' => 1,
                'description' => 'Loan Sent.',
                'color_code' => '#89CFF0',
                'created_by' => 1,
                'updated_by' => 1,
            ]

        ]);
    }
}
