<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginService
{
    public function loginUser($data)
    {
        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['This email is not registered.'],
            ]);
        }
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw ValidationException::withMessages([
                'password' => ['Password incorrect.'],
            ]);
        }
        return Auth::user();
    }
}
