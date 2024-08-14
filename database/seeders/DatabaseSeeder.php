<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


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
                'type' => '0',
                'dob' => Carbon::create('2000', '01', '01'),
                'created_user_id' => '1',
                'updated_user_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at'=> Carbon::now(),


            ],

        );


    }
}
