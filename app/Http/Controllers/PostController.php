<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use App\Services\PostService;
use Illuminate\Foundation\Mix;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * This function return to post list page and compact post data by the type of user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postListPage(Request $request)
    {

        $searchTerm = $request->input('searchKey');
        $post = new Post();
        $posts = $post->search($searchTerm);
        // dd($posts);
        return view('post.postList', compact('posts', 'searchTerm'));
    }

    /**
     * This function return to Post Create Page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postCreatePage()
    {
        return view('post.createPost');
    }

    public function postEditPage($id)
    {
        $post = Post::find($id);
        return view('post.editPost', compact('post'));
    }

    public function postEditConfirmPage(PostCreateRequest $request)
    {
        $request->validated();
        $post = $request->all('id', 'title', 'body');
        // dd($post);
        return view('post.confirmEditPost', compact('post'));
    }
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Pass created input data to post confirm page
     * @param \App\Http\Requests\PostCreateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(PostCreateRequest $request)
    {

        $data = $request->only('title', 'body');
        $request->validated();
        return view('post.confirmCreatePost', compact('data'));
    }

    /**
     * Store function work for new post creation and post update
     * @param \App\Http\Requests\PostCreateRequest $request
     * @return
     */
    public function store(PostCreateRequest $request)
    {

        $id = $request->id;
        if ($id) {
            $post = Post::find($id);

            if (!$post) {
                return redirect()->back()->with('error', 'Post not found.');
            }
            $request->validated();
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->updated_user_id = Auth::id(); // Store the ID of the user who updated the post
            $post->update();

            return redirect()->route('post.postlist')->with('success', 'Post updated successfully.');
        } else {
            $post = $this->postService->createPost($request->validated());
            if ($post) {
                return redirect()->route('post.postlist')->with('success', 'Post created successfully.');
            }
        }
    }

    /**
     * Soft Delete Function
     * @param mixed $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
        }

        return redirect()->route('post.postlist')->with('success', 'Post deleted successfully.');
    }
}
