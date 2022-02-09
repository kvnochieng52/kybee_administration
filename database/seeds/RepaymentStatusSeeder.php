<?php

use Illuminate\Database\Seeder;

class RepaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('repayment_statuses')->insert([
            [
                'repayment_status_name' => 'Open',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'repayment_status_name' => 'Closed',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

        ]);
    }
}
