<?php

use Illuminate\Database\Seeder;

class InterestRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interest_rates')->insert([
            [
                'interest_percentage' => 25,
                'commission_percentage' => 5,
                'active_rate' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],

        ]);
    }
}
