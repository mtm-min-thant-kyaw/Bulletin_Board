<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Exception;

class LoginService
{
    /**
     * Login function and validation message for login page
     * @param mixed $data
     * @return Authenticatable
     */
    public function loginUser($data) : Authenticatable
    {
       try{
        DB::beginTransaction();
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
        DB::commit();
        return Auth::user();
       }catch (Exception $e){
        DB::rollBack();
        throw $e;
       }

    }
}
