<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            $customersData = [
                [
                    'name' => 'Min Thant Kyaw',
                    'email' => 'mtm.minthantkyaw@gmail.com',
                    'password' => Hash::make('Min553238@'),
                    'phone' => '09-880576046',
                    'address' => 'Kanbalu',
                    'type' => '0',
                    'dob' => Carbon::create('2000', '01', '01'),
                    'created_user_id' => '1',
                    'updated_user_id' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'name' => 'User',
                    'email' => 'minthant1590@gmail.com',
                    'password' => Hash::make('Min553238@'),
                    'phone' => '09-880576040',
                    'address' => 'Yangon',
                    'type' => '1',
                    'dob' => Carbon::create('2001', '10', '01'),
                    'created_user_id' => '1',
                    'updated_user_id' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],

            ];

            foreach ($customersData as $data) {
                $customers  = new User();
                $customers->fill($data)->save($data);
            }
        });
    }
}
