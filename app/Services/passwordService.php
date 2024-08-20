<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\passwordChangeRequest;
use App\Mail\ResetMail;
use App\Models\PasswordReset;
use App\Models\User;

class passwordService
{
    /**
     * Password Change Function
     * @param \App\Http\Requests\passwordChangeRequest $request
     * @return bool
     */
    public function passwordChange(passwordChangeRequest $request): bool
    {
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id', $currentUserId)->first();
        $dbPassword = $user->password;
        if (Hash::check($request->password, $dbPassword)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            return true;
        }
        throw ValidationException::withMessages([
            'password' => ['Current password is wrong.'],
        ]);
    }

    /**
     * Email sent to user
     * @param mixed $email
     * @param mixed $token
     * @return void
     */
    public function sendPasswordResetEmail($email, $token): void
    {
        $user = User::where('email', $email)->first();
        $token = PasswordReset::createPasswordResetToken($email);
        Mail::to($user->email)->send(new ResetMail($user, $token));
    }

    /**
     * Summary of findUserByToken
     * @param mixed $token
     * @return object|null
     */
    public function findUserByToken($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if ($passwordReset) {
            $user = User::where('email', $passwordReset->email)->first();
            return $user;
        } else {
            return null;
        }
    }

    /**
     * Reset Password and delete token
     * @param mixed $email
     * @param mixed $password
     * @return void
     */
    public function updateUserPassword($email, $password)
    {
        User::where('email', $email)->update(['password' => Hash::make($password)]);
        DB::table('password_resets')->where('email', $email)->delete();
    }
}
