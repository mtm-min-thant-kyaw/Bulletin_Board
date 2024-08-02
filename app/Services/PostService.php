<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Constraints\HasInDatabase;

class PostService
{
    public function createPost($data)
    {
        try {
            $post = new Post();
            $post->title = $data['title'];
            $post->body = $data['body'];
            $post->created_user_id = Auth::id();
            $post->updated_user_id = null;
            $post->deleted_user_id = null;
            $post->save();

            return $post;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}





// // Validate the request data
//     if ($id) {
//     // Update existing post
//     $post = Post::find($id);

//     if (!$post) {
//     return redirect()->back()->with('error', 'Post not found.');
//     }

//     $post->title = $request->input('title');
//     $post->body = $request->input('body');
//     $post->updated_user_id = Auth::id(); // Store the ID of the user who updated the post
//     $post->save();

//     return redirect()->route('post.postlist')->with('success', 'Post updated successfully.');
//     } else {
//     // Create new post
//     $post = new Post();
//     $post->title = $request->input('title');
//     $post->body = $request->input('body');
//     $post->created_user_id = Auth::id(); // Store the ID of the user who created the post
//     $post->save();

//     return redirect()->route('post.postlist')->with('success', 'Post created successfully.');
