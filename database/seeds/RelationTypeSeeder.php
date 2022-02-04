<?php

use Illuminate\Database\Seeder;

class RelationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relation_types')->insert([
            [
                'relationship_type_name' => 'Mother',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'relationship_type_name' => 'Father',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'relationship_type_name' => 'Brother',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'relationship_type_name' => 'Sister',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'relationship_type_name' => 'Friend',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'relationship_type_name' => 'Colleague',
                'visible' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]

        ]);
    }
}
