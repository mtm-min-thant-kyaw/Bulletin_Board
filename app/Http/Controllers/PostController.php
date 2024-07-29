<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    public function postListPage()
    {
        $posts = Post::all();

        return view('post.postList', compact('posts'));
    }

    public function postCreatePage()
    {
        return view('post.createPost');
    }

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Post Create Function
     * @param \App\Http\Requests\PostCreateRequest $request
     * @return void
     */
    public function postCreate(PostCreateRequest $request)
    {
        $post = $this->postService->createPost(($request->validated()));
        if ($post) {
            return response()->json();
        } else {
            return response()->json();
        }
    }
}
