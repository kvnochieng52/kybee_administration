<?php

use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marital_statuses')->insert([
            [
                'marital_status_name' => 'Married',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'marital_status_name' => 'Divorced',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'marital_status_name' => 'Single',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]

        ]);
    }
}
