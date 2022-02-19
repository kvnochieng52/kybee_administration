<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_groups')->insert([
            [
                'group_name' => 'Loan Requests',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'group_name' => 'Loan Repayments',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'group_name' => 'Settings',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'group_name' => 'Users',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ]


        ]);
    }
}
