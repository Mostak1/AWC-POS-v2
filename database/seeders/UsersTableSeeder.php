<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'email_verified_at' => null,
                'password' => '$2y$10$zEtu.lHZKPiP/K0j5AiTX.MNpsU0fWihi7093saP8bEUkQiFTa.iq',
                'remember_token' => null,
                'created_at' => '2023-10-05 12:43:57',
                'updated_at' => '2023-10-06 08:11:23',
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'Mostak Ahmed',
                'email' => 'mostak@gmail.com',
                'username' => 'Admin',
                'email_verified_at' => null,
                'password' => '$2y$10$zEtu.lHZKPiP/K0j5AiTX.MNpsU0fWihi7093saP8bEUkQiFTa.iq',
                'remember_token' => null,
                'created_at' => '2023-10-05 12:45:32',
                'updated_at' => '2023-10-14 10:36:10',
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'name' => 'User',
                'email' => 'user2@gmail.com',
                'username' => 'user2',
                'email_verified_at' => null,
                'password' => '$2y$10$J6pKq9NNOeq1wXSgU85mPu8cyo0o1783mXXdy2kcTLLYynUpZ.Hry',
                'remember_token' => null,
                'created_at' => '2023-10-06 08:25:47',
                'updated_at' => '2023-10-19 09:38:38',
                'deleted_at' => null,
            ],
            // Add entries for other users here...
        ];

        // Insert data into the 'users' table
        DB::table('users')->insert($users);
    }
}
