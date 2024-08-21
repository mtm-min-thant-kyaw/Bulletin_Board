<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;
use App\Http\Requests\PostCreateRequest;
use App\Services\PostService;
use App\Models\Post;

class PostController extends Controller
{

    protected $postService;
    /**
     *
     * @param \App\Services\PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * This function return to post list page and compact post data by the type of user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postListPage(Request $request): View
    {
        $searchTerm = $request->input('searchKey');
        $posts = $this->postService->getPosts($searchTerm);

        return view('post.postList', compact('posts', 'searchTerm'));
    }

    /**
     * This function return to Post Create Page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postCreatePage(): View
    {
        return view('post.createPost');
    }

    /**
     * Summary of postEditPage
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postEditPage($id): View
    {
        $post = Post::find($id);
        return view('post.editPost', compact('post'));
    }

    /**
     * Handel for preview data to confrim
     * @param \App\Http\Requests\PostCreateRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function previewEdit(PostCreateRequest $request, Post $post): View
    {
        $validatedData = $request->all();
        $updatedPost = $this->postService->handleEditPreview($post, $validatedData);

        return view('post.confirmEditPost', compact('post', 'updatedPost'));
    }

    /**
     * This function is post update function
     * @param \App\Http\Requests\PostCreateRequest $request
     * @param \App\Models\Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->postService->updatePost($post, $request->all());
            DB::commit();
            return redirect()->route('post.postlist', $post)->with('success', 'Post updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('post.edit', $post)->with('error', $e->getMessage());
        }
    }
    /**
     * Pass created input data to post confirm page
     * @param \App\Http\Requests\PostCreateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(PostCreateRequest $request): View
    {
        $data = $request->only('title', 'description');
        $request->validated();
        return view('post.confirmCreatePost', compact('data'));
    }

    /**
     * Store function work for new post creation and post update
     * @param \App\Http\Requests\PostCreateRequest $request
     * @return
     * @return
     */
    public function store(Request $request)
    {

        $post = $this->postService->createPost($request->all());
        if ($post) {
            return redirect()->route('post.postlist')->with('success', 'Post created successfully.');
        }
    }
    /**
     * Soft Delete Function
     * @param mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
        }

        return redirect()->route('post.postlist')->with('success', 'Post deleted successfully.');
    }

    /**
     * Upload function for csv file
     * @return ViewView|\Illuminate\Contracts\View\Factory
     */
    public function uploadPage(): View
    {
        return view('post.csvUpload');
    }

    /**
     * Post csv file upload function
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function uploadCsv(Request $request): RedirectResponse
    {
        $request->validate(['csv_file' => 'required|file|mimes:csv']);
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = file_get_contents($file);
            $this->postService->uploadCsvData($csvData);
        }
        return redirect()->route('post.postlist')->with('success', 'CSV data uploaded successfully.');
    }

    /**
     * Download the search result with excel format
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadExcel(Request $request)
    {
        $searchTerm = $request->input('searchKey');
        $writer = $this->postService->generateExcelFile($searchTerm);

        $filename = 'posts.xlsx';
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }
}
