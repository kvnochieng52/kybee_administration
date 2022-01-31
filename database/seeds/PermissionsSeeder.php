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
            [
                'name' => 'Create Product',
                'guard_name' => 'web',
                'p_group' => '1',

            ],

            [
                'name' => 'View Products',
                'guard_name' => 'web',
                'p_group' => '1',

            ], [
                'name' => 'View All Products',
                'guard_name' => 'web',
                'p_group' => '1',

            ],

            [
                'name' => 'Edit Product',
                'guard_name' => 'web',
                'p_group' => '1',

            ],

            [
                'name' => 'Delete Product',
                'guard_name' => 'web',
                'p_group' => '1',

            ],


            [
                'name' => 'Create business',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'View business',
                'guard_name' => 'web',
                'p_group' => '2',

            ], [
                'name' => 'View All business',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'Edit business',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'Delete business',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'Create Customer',
                'guard_name' => 'web',
                'p_group' => '3',

            ],

            [
                'name' => 'View Customers',
                'guard_name' => 'web',
                'p_group' => '3',

            ], [
                'name' => 'View All Customers',
                'guard_name' => 'web',
                'p_group' => '3',

            ],

            [
                'name' => 'Edit Customer',
                'guard_name' => 'web',
                'p_group' => '3',

            ],

            [
                'name' => 'Delete Customer',
                'guard_name' => 'web',
                'p_group' => '3',

            ],





            [
                'name' => 'Create Job Card',
                'guard_name' => 'web',
                'p_group' => '4',

            ],

            [
                'name' => 'View Job Cards',
                'guard_name' => 'web',
                'p_group' => '4',

            ], [
                'name' => 'View All Job Cards',
                'guard_name' => 'web',
                'p_group' => '4',

            ],

            [
                'name' => 'Edit Job Card',
                'guard_name' => 'web',
                'p_group' => '4',

            ],

            [
                'name' => 'Delete Job Card',
                'guard_name' => 'web',
                'p_group' => '4',

            ],






            [
                'name' => 'Manage Categories',
                'guard_name' => 'web',
                'p_group' => '5',

            ],

            [
                'name' => 'Manage Product Types',
                'guard_name' => 'web',
                'p_group' => '5',

            ], [
                'name' => 'Manage Product Models',
                'guard_name' => 'web',
                'p_group' => '5',

            ],

            [
                'name' => 'Manage Districts',
                'guard_name' => 'web',
                'p_group' => '5',

            ],

            [
                'name' => 'Manage Towns',
                'guard_name' => 'web',
                'p_group' => '5',

            ],



            [
                'name' => 'Product Reports',
                'guard_name' => 'web',
                'p_group' => '6',

            ],


            [
                'name' => 'Business Reports',
                'guard_name' => 'web',
                'p_group' => '6',

            ],





            [
                'name' => 'Create User',
                'guard_name' => 'web',
                'p_group' => '7',

            ],

            [
                'name' => 'View Users',
                'guard_name' => 'web',
                'p_group' => '7',

            ], [
                'name' => 'View All Users',
                'guard_name' => 'web',
                'p_group' => '7',

            ],

            [
                'name' => 'Edit User',
                'guard_name' => 'web',
                'p_group' => '7',

            ],

            [
                'name' => 'Delete User',
                'guard_name' => 'web',
                'p_group' => '7',

            ],

        ]);
    }
}
