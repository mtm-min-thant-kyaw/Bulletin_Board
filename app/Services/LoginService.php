<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class LoginService
{
    /**
     * Login function and store login data in cookie
     * @param mixed $data
     * @return array
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

    /**
     * return array|null
     */
    public function getCacheData()
    {
        return Cache::get('remember_data');
    }
}
