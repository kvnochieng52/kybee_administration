<?php

use Illuminate\Database\Seeder;

class SalaryRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salary_ranges')->insert([
            [
                'salary_range' => 'below 10,000',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'salary_range' => '10,000-25,000',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'salary_range' => '25,000-50,000',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'salary_range' => 'above 50,000',
                'created_by' => 1,
                'updated_by' => 1,
            ]

        ]);
    }
}
