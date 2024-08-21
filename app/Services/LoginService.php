<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class LoginService
{
    /**
     * loginUser
     * @param mixed $data
     * @param mixed $remember
     * @return
     */
    public function loginUser($data, $remember)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (Auth::attempt($credentials)) {
            if ($remember) {
                cache()->put('remember_data', $credentials);
            }
            return ['success'];
        }


        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['This email is not registered.'],
            ]);
        }
        throw ValidationException::withMessages([
            'password' => ['Password incorrect.'],
        ]);
    }
    public function getCacheData()
    {
        return Cache::get('remember_data');
    }
}
