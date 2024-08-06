<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => 'Min Thant Kyaw',
                'email' => 'minthant1590@gmail.com',
                'password' => Hash::make('Min553238@'),
                'phone' => '09-880576046',
                'address' => 'Kanbalu',
                'type' => '1',
                'dob' => '2000-10-10',
                'created_user_id' => '1',
                'updated_user_id' => '1',
            ]
        );
    }
}
