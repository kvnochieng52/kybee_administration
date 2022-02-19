<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([

            //LOAN REQUESTS PERMISSIONS
            [
                'name' => 'Create Loan Requests',
                'guard_name' => 'web',
                'p_group' => '1',

            ],

            [
                'name' => 'View Loan Requests',
                'guard_name' => 'web',
                'p_group' => '1',

            ], [
                'name' => 'Edit Loan Requests',
                'guard_name' => 'web',
                'p_group' => '1',

            ],


            [
                'name' => 'Delete Loan Requests',
                'guard_name' => 'web',
                'p_group' => '1',

            ],

            //LOAN REPAYMENTS PERMISSIONS


            [
                'name' => 'Create Loan Repayment',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'View Loan Repayment',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'Edit Loan Repayment',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'Delete Loan Repayment',
                'guard_name' => 'web',
                'p_group' => '2',

            ],


            //SETTINGS PERMISSIONS


            [
                'name' => 'Manage Settings',
                'guard_name' => 'web',
                'p_group' => '3',

            ],



            //USER PERMISSIONS


            [
                'name' => 'Create User',
                'guard_name' => 'web',
                'p_group' => '4',

            ],

            [
                'name' => 'View Users',
                'guard_name' => 'web',
                'p_group' => '4',

            ], [
                'name' => 'View All Users',
                'guard_name' => 'web',
                'p_group' => '4',

            ],

            [
                'name' => 'Edit User',
                'guard_name' => 'web',
                'p_group' => '4',

            ],

            [
                'name' => 'Delete User',
                'guard_name' => 'web',
                'p_group' => '4',

            ],

        ]);
    }
}
