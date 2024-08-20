<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

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
