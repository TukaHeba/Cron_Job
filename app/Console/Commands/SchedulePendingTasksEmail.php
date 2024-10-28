<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendPendingTasksEmail;
use Illuminate\Support\Facades\Log;

class SchedulePendingTasksEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:send-pending-tasks-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch the job to send pending tasks email to all users daily';

    /**
     * Execute the console command.
     * 
     * Start with logging a start message.
     * Dispatches the SendPendingTasksEmail job, 
     * End with logging a completed message.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Starting scheduled command to dispatch SendPendingTasksEmail job.');

        SendPendingTasksEmail::dispatch();
        $this->info('Scheduled job to send pending tasks email dispatched.');

        Log::info('SendPendingTasksEmail job successfully dispatched.');
    }
}
