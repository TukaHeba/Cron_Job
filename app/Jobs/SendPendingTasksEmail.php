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
     * Retrieve all tasks that have pending status with eager loading for assignedTo relationship.
     * If there is no pending tasks log amessage and exit.
     * Send the PendingTasksEmail to each user with the pending tasks.
     * Get admin users & send to them email with all pending tasks.
     * Send email to each non-admin user with their assigned pending tasks
     * End with logging a completed message.
     * 
     * @return void
     */
    public function handle(): void
    {
        Log::info('SendPendingTasksEmail job started.');

        $tasks = Task::where('status', 'pending')->with('assignedTo')->get();
        if ($tasks->isEmpty()) {
            Log::info('No pending tasks to send emails for.');
            return;
        }

        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new PendingTasksMail($tasks, $admin));
        }

        $tasks->groupBy('assigned_to')->each(function ($userTasks, $userId) use ($admins) {
            // Skip if the user is an admin
            if ($admins->pluck('id')->contains($userId)) {
                return;
            }

            // Other users send them only their assigned pending tasks
            $user = User::find($userId);
            if ($user) {
                Mail::to($user->email)->send(new PendingTasksMail($userTasks, $user));
            }
        });

        Log::info('SendPendingTasksEmail job completed.');
    }
}
