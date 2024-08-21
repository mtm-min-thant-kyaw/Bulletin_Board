<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PasswordReset extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'token'];
    /**
     * Create sercure token for reset password
     * @param string $email
     * @return string
     */
    public static function createPasswordResetToken(string $email): string
    {
        $token = Str::random(60);

        self::insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        return $token;
    }
}
