<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Cashier',
                'guard_name' => 'web',
                'created_at' => '2023-10-14 09:21:03',
                'updated_at' => '2023-10-14 11:02:56',
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-14 09:21:23',
                'updated_at' => '2023-10-14 09:21:23',
            ],
            [
                'id' => 3,
                'name' => 'Manager',
                'guard_name' => 'web',
                'created_at' => '2023-10-16 09:52:49',
                'updated_at' => '2023-10-16 09:52:49',
            ],
            [
                'id' => 5,
                'name' => 'Silver',
                'guard_name' => 'web',
                'created_at' => '2023-10-18 07:54:13',
                'updated_at' => '2023-10-18 07:54:13',
            ],
            [
                'id' => 6,
                'name' => 'Apple',
                'guard_name' => 'web',
                'created_at' => '2023-10-18 07:57:56',
                'updated_at' => '2023-10-18 07:57:56',
            ],
            // Add entries for other roles here...
        ];

        // Insert data into the 'roles' table
        DB::table('roles')->insert($roles);
    }
}
