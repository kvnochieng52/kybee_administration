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
                'group_name' => 'Admin',
                'guard_name' => 'web',

            ], [
                'group_name' => 'Supervisor',
                'guard_name' => 'web',

            ], [
                'group_name' => 'Field Officer',
                'guard_name' => 'web',

            ], [
                'group_name' => 'Standard',
                'guard_name' => 'web',

            ]

        ]);
    }
}
