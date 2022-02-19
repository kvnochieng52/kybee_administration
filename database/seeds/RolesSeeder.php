<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Customer',
                'guard_name' => 'web',
            ], [
                'name' => 'Supervisor',
                'guard_name' => 'web',
            ], [
                'name' => 'Admin',
                'guard_name' => 'web',

            ],

        ]);
    }
}
