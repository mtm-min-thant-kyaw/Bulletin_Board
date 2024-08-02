<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'created_user_id',
        'updated_user_id',
        'deleted_user_id',
        'deleted_at',
    ];

    // Define relationship to the User model for created, updated, and deleted users
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function updateUser()
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_user_id');
    }

    public  function search($searchTerm)
    {
        $user = Auth::user();
        $query = Post::query();

        if ($user->type != 1) {
            $query->where('created_user_id', $user->id);
        }
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('body', 'LIKE', "%{$searchTerm}%");
            });
        }

        $post = $query->with('user','updateUser')->latest()->paginate(5);
        return $post;
    }
}
