<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class PostService
{
    public function createPost($data)
    {
        $user = new Post();
        $user->title = $data['title'];
        $user->body = $data['body'];
        $user->created_user_id = Auth::id();
        $user->updated_user_id = null;
        $user->deleted_user_id = null;
        $user->save();

        return $user;
    }
}
