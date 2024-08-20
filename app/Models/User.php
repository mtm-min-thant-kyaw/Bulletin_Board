<?php

namespace App\Models;

use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'type',
        'dob',
        'profile',
        'created_user_id',
        'updated_user_id',
        'deleted_user_id',
        'deleted_at',
    ];

    /**
     * Define a one-to-many relationship with Post.
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'created_user_id');
    }

    /**
     * Return created user of a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createUser()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function updateUser()
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }

    /**
     * Search query for users
     * @param mixed $query
     * @param mixed $filters
     * @return mixed
     */
    public function scopeSearch($query, $filters)
    {

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (!empty($filters['startDate']) && empty($filters['endDate'])) {
            $query->whereDate('created_at', $filters['startDate']);
            } elseif (!empty($filters['startDate']) && !empty($filters['endDate'])) {
            $query->whereDate('created_at', '>=', $filters['startDate'])
            ->whereDate('created_at', '<=', $filters['endDate']);
         } elseif (empty($filters['startDate']) && !empty($filters['endDate'])) {
            $query->whereDate('created_at', '<=', $filters['endDate']); }

        return $query;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     *
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'datetime:Y-m-d',
        'deleted_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
