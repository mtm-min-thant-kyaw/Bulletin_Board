<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendBdWish;

class PushQueues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:queues';

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
        for ($i = 0; $i < 100; ++$i) {
            SendBdWish::dispatch($i);
        }
    }
}
