<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        User::factory()->create([
            'name' => "Min Thant Kyaw",
            'email' =>" minthant1590@gmail.com",
            'password' => Hash::make('Min553238@'),
            'phone' => '09-880576046',
            'address' => 'Kanbalu',
            'type' => '1',
            'dob' => '2000-10-10',
            'created_user_id' => '1',
            'updated_user_id' => '1',
            'deleted_user_id' => '1',
            'deleted_at' => Carbon::now(),


        ]);
        // User::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
