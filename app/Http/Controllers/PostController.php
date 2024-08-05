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

    public function uploadCsv(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = file_get_contents($file);
            $rows = array_map('str_getcsv', explode("\n", $csvData));
            $header = array_shift($rows);

            foreach ($rows as $row) {
                if (count($header) == count($row)) {
                    $row = array_combine($header, $row);
                    Post::create([
                        'title' => $row['title'],
                        'body' => $row['body'],
                        'created_user_id' => Auth::user()->id,
                    ]);
                }
            }
        }else{
            return redirect()->back()->with('success','Please Select Csv File');
        }

        return redirect()->route('post.postlist')->with('success', 'CSV data uploaded successfully.');
    }

    public function downloadExcel(Request $request)
    {
        $user = Auth::user();
        $searchTerm = $request->input('searchKey');

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

        $posts = $query->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Body');
        $sheet->setCellValue('D1', 'Created User ID');
        $sheet->setCellValue('E1', 'Created At');

        // Add data rows
        $row = 2;
        foreach ($posts as $post) {
            $sheet->setCellValue('A' . $row, $post->id);
            $sheet->setCellValue('B' . $row, $post->title);
            $sheet->setCellValue('C' . $row, $post->body);
            $sheet->setCellValue('D' . $row, $post->created_user_id);
            $sheet->setCellValue('E' . $row, $post->created_at);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $filename = 'Post-List.xlsx';
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
