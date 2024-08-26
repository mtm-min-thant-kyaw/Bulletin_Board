<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostService
{

    /**
     * Summary of createPost
     * @param mixed $data
     * @return Post
     */
    public function createPost($data) : Post
    {

        $post = new Post();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->status = 1;
        $post->created_user_id = Auth::id();
        $post->updated_user_id = Auth::id() ?? null;
        $post->deleted_user_id = null;
        $post->save();

        return $post;
    }

    /**
     * Preview function for edited post to confirm
     * @param $post
     * @param $validatedData
     * @return array
     */
    public function handleEditPreview($post, $validatedData): array
    {
        $updatedPost = [
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
        ];

        return $updatedPost;
    }

    /**
     * Update Function for post
     * @param $post
     * @param array $data
     * @return Post
     */
    public function updatePost(Post $post, array $data): Post
    {
        $post->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'updated_user_id' => Auth::id(),
        ]);

        return $post;
    }

    /**
     * Get posts by the type of user
     * @param $searchTerm
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPosts($searchTerm = null)
    {
        return Post::getFilteredPosts($searchTerm);
    }

    /**
     * Summary of uploadCsvData
     * @param $csvData
     * @return void
     */
    public function uploadCsvData($csvData) : void
    {
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($header) == count($row)) {
                $row = array_combine($header, $row);
                Post::create([
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'created_user_id' => Auth::user()->id,
                    'updated_user_id' => Auth::user()->id,
                ]);
            }
        }
    }

    /**
     * Summary of generateExcelFile
     * @param mixed $searchTerm
     * @return \PhpOffice\PhpSpreadsheet\Writer\Xlsx
     */
    public function generateExcelFile($searchTerm = null)
    {
        $posts = $this->getPosts($searchTerm);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Description');
        $sheet->setCellValue('D1', 'Ststus');
        $sheet->setCellValue('E1', 'Created User ID');
        $sheet->setCellValue('F1', 'Updated User ID');
        $sheet->setCellValue('G1', 'Deleted User ID');
        $sheet->setCellValue('H1', 'Created At');
        $sheet->setCellValue('I1', 'Updated At');
        $sheet->setCellValue('J1', 'Deleted At');

        $row = 2;
        foreach ($posts as $post) {
            $sheet->setCellValue('A' . $row, $post->id);
            $sheet->setCellValue('B' . $row, $post->title);
            $sheet->setCellValue('C' . $row, $post->description);
            $sheet->setCellValue('D' . $row, $post->status);
            $sheet->setCellValue('E' . $row, $post->created_user_id);
            $sheet->setCellValue('F' . $row, $post->updated_user_id);
            $sheet->setCellValue('G' . $row, $post->deleted_user_id);
            $sheet->setCellValue('H' . $row, $post->created_at->format('Y/m/d'));
            $sheet->setCellValue('I' . $row, $post->updated_at->format('Y/m/d'));
            $sheet->setCellValue('J' . $row, $post->deleted_at);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        return $writer;
    }
    /**
     * Post delete
     * @param int $id
     * @return bool
     */
    public function softDeletePost(int $id): bool
    {
        $post = Post::find($id);
        if ($post) {
            return $post->delete();
        }

        return false;
    }
}
