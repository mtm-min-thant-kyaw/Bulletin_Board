<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\DailyPostReport;
use App\Models\Post;
use App\Models\User;

class EmailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:daily-post-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $yesterday = now()->subDay()->toDateString();
        $posts = Post::where('status', 1)
        ->whereDate('created_at', $yesterday)
        ->latest()
        ->take(10)
        ->get();
         $admins = User::where('type', '0')->get();
         Log::info(($posts));
         foreach ($admins as $admin) {
             Mail::to($admin->email)->send(new DailyPostReport($posts));
         }

         $this->info('Daily posts report sent to admins.');
         return 0;
    }
}
