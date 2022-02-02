<?php

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            [
                'gender_name' => 'Male',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'gender_name' => 'Female',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'gender_name' => 'Other',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        ]);
    }
}
