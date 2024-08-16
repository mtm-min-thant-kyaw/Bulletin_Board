<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\passwordChangeRequest;
use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\passwordResetMail;
use Illuminate\Contracts\Auth\Authenticatable;

class passwordService
{
    public function passwordChange(passwordChangeRequest $request)
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

}

