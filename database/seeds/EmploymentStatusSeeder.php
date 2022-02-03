<?php

use Illuminate\Database\Seeder;

class EmploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employment_statuses')->insert([
            [
                'employment_status_name' => 'Employed',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'employment_status_name' => 'Casual_labourer',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'employment_status_name' => 'Business_person',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'employment_status_name' => 'Self_employed',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

        ]);
    }
}
