<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\PendingTasksMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendPendingTasksEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     * 
     * Start with logging a start message.
     * Retrieve all tasks that have pending status.
     * Send the PendingTasksEmail to each user with the pending tasks.
     * End with logging a completed message.
     * 
     * @return void
     */
    public function handle(): void
    {
        Log::info('SendPendingTasksEmail job started.');

        $tasks = Task::where('status', 'pending')->get();

        User::all()->each(function ($user) use ($tasks) {
            Mail::to($user->email)->send(new PendingTasksMail($tasks, $user));
        });

        Log::info('SendPendingTasksEmail job completed.');
    }
}
