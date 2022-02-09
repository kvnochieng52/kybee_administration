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
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'loan_status_name' => 'Approved',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            [
                'loan_status_name' => 'Declined',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'loan_status_name' => 'Sent',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]

        ]);
    }
}
