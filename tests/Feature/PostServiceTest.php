<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;
use Tests\TestCase;

class PostServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $postService;
    protected $user; // To store the created user

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and log them in
        $this->user = User::create([
            'name' => 'Min Thant Kyaw',
            'email' => 'minthant1590@gmail.com',
            'password' => Hash::make('Min553238@'),
            'phone' => '09-880576046',
            'address' => 'Kanbalu',
            'type' => '0',
            'dob' => Carbon::create('2000', '01', '01'),
            'created_user_id' => '1',
            'updated_user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),


        ],);
        Auth::login($this->user); // Log in the user for the duration of the test

        $this->postService = new PostService();
    }

    public function test_create_post()
    {
        $data = [
            'title' => 'Test Post Title',
            'description' => 'Test Post Description',
        ];

        $post = $this->postService->createPost($data);

        // Assert that the post was created in the database
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title',
            'description' => 'Test Post Description',
            'status' => 1,
            'created_user_id' => $this->user->id,
            'updated_user_id' => $this->user->id,
        ]);

        // Assert that a post object was returned
        $this->assertInstanceOf(Post::class, $post);
    }

    public function test_update_post()
    {
        $data = [
            'title' => 'Test Post Title',
            'description' => 'Test Post Description',
        ];

        $post = $this->postService->createPost($data);

        // New data for the update
        $newData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status' => 1,
        ];

        // Call the update method
        $updatedPost = $this->postService->updatePost($post, $newData);

        // Assert that the post was updated in the database
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status' => 1,
            'updated_user_id' => $this->user->id,
        ]);

        // Assert that the returned post is the updated post
        $this->assertInstanceOf(Post::class, $updatedPost);
        $this->assertEquals('Updated Title', $updatedPost->title);
        $this->assertEquals('Updated Description', $updatedPost->description);
        $this->assertEquals(1, $updatedPost->status);
        $this->assertEquals($this->user->id, $updatedPost->updated_user_id);
    }

    public function test_delete_post()
    {
        // Create a post and delete it
        $data = [
            'title' => 'Test Post Title',
            'description' => 'Test Post Description',
        ];

        $post = $this->postService->createPost($data);
        // Ensure the post exists in the database
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
        ]);

        // Call the soft delete method with the post ID
        $result = $this->postService->softDeletePost($post->id);

        // Assert that the delete method returned true
        $this->assertTrue($result);

        // Assert that the post no longer exists in the database
        $this->assertSoftDeleted('posts', [
            'id' => $post->id,
        ]);
    }

    public function test_upload_csv_data()
    {
        // CSV data as a string
        $csvData = "title,description\nTest Post Title 1,Test Post Description 1\nTest Post Title 2,Test Post Description 2";

        // Call the uploadCsvData method
        $this->postService->uploadCsvData($csvData);

        // Assert that the posts were created in the database
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title 1',
            'description' => 'Test Post Description 1',
            'created_user_id' => $this->user->id,
            'updated_user_id' => $this->user->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title 2',
            'description' => 'Test Post Description 2',
            'created_user_id' => $this->user->id,
            'updated_user_id' => $this->user->id,
        ]);
    }
    public function test_download_excel_file()
    {
        // Create some posts
        Post::factory()->count(3)->create([
            'created_user_id' => $this->user->id,
            'updated_user_id' => $this->user->id,
        ]);

        // Call the generateExcelFile method
        $writer = $this->postService->generateExcelFile();

        // Save the generated Excel file to a temporary location
        $filePath = storage_path('app/public/posts.xlsx');
        $writer->save($filePath);

        // Load the saved Excel file
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();

        $this->assertEquals('ID', $sheet->getCell('A1')->getValue());
        $this->assertEquals('Title', $sheet->getCell('B1')->getValue());
        $this->assertEquals('Description', $sheet->getCell('C1')->getValue());
        $this->assertEquals('Ststus', $sheet->getCell('D1')->getValue());
        $this->assertEquals('Created User ID', $sheet->getCell('E1')->getValue());
        $this->assertEquals('Updated User ID', $sheet->getCell('F1')->getValue());
        $this->assertEquals('Deleted User ID', $sheet->getCell('G1')->getValue());
        $this->assertEquals('Created At', $sheet->getCell('H1')->getValue());
        $this->assertEquals('Updated At', $sheet->getCell('I1')->getValue());
        $this->assertEquals('Deleted At', $sheet->getCell('J1')->getValue());

        // Check the data rows
        $row = 2;
        foreach (Post::all() as $post) {
            $this->assertEquals($post->id, $sheet->getCell('A' . $row)->getValue());
            $this->assertEquals($post->title, $sheet->getCell('B' . $row)->getValue());
            $this->assertEquals($post->description, $sheet->getCell('C' . $row)->getValue());
            $this->assertEquals($post->status, $sheet->getCell('D' . $row)->getValue());
            $this->assertEquals($post->created_user_id, $sheet->getCell('E' . $row)->getValue());
            $this->assertEquals($post->updated_user_id, $sheet->getCell('F' . $row)->getValue());
            $this->assertEquals($post->deleted_user_id, $sheet->getCell('G' . $row)->getValue());
            $this->assertEquals($post->created_at->format('Y/m/d'), $sheet->getCell('H' . $row)->getValue());
            $this->assertEquals($post->updated_at->format('Y/m/d'), $sheet->getCell('I' . $row)->getValue());
            $this->assertEquals($post->deleted_at, $sheet->getCell('J' . $row)->getValue());
            $row++;
        }

        // Clean up the generated file
        unlink($filePath);
    }
}
