<?php

use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_levels')->insert([
            [
                'education_level_name' => 'pre_high_school',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'education_level_name' => 'high_school',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'education_level_name' => 'special_secondary_school',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'education_level_name' => 'junior_college',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'education_level_name' => 'under_graduate',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'education_level_name' => 'post_graduate',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]

        ]);
    }
}
