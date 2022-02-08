<?php

use Illuminate\Database\Seeder;

class LoanDistributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loan_distributions')->insert([
            [
                'max_amount' => 1000,
                'period' => 7,
                'order' => 1,
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            [
                'max_amount' => 2500,
                'period' => 14,
                'order' => 2,
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            [
                'max_amount' => 5000,
                'period' => 21,
                'order' => 3,
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            [
                'max_amount' => 10000,
                'period' => 28,
                'order' => 4,
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            [
                'max_amount' => 15000,
                'period' => 35,
                'order' => 5,
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            [
                'max_amount' => 30000,
                'period' => 42,
                'order' => 6,
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

        ]);
    }
}
