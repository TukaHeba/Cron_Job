<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskService
{
    /**
     * List all tasks if the auth user is admin, otherwise only tasks assigned to the auth user.
     * Define a cache key and cache for 60 minutes.
     * 
     * @param mixed $user
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function listAllTasks($user)
    {
        $cacheKey = 'tasksByUser_' . $user->id;

        return Cache::remember($cacheKey, 60, function () use ($user) {
            if ($user->is_admin) {
                return Task::with(['assignedTo', 'createdBy'])->get();
            }

            $tasks = Task::with(['assignedTo', 'createdBy'])
                ->where('assigned_to', $user->id)
                ->orWhere('created_by', $user->id)->get();
            return $tasks;
        });
    }

    /**
     * Create a new task and assign the authenticated user as the creator & clear the cache for the user.
     * 
     * @param array $data
     * @return Task|\Illuminate\Database\Eloquent\Model
     */
    public function createTask(array $data)
    {
        $data['created_by'] = Auth::id();
        $task = Task::create($data);

        Cache::forget('tasksByUser_' . Auth::id());

        return $task;
    }

    /**
     * Update the specified task with the given data and clear the cache for the user.
     * 
     * @param \App\Models\Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data)
    {
        $task->update(array_filter($data));

        Cache::forget('tasksByUser_' . $task->assigned_to);
        Cache::forget('tasksByUser_' . $task->created_by);

        return $task;
    }

    /**
     * Delete the specified task and clear the cache for the user.
     * 
     * @param \App\Models\Task $task
     * @return void
     */
    public function deleteTask(Task $task)
    {
        $task->delete();

        Cache::forget('tasksByUser_' . $task->assigned_to);
        Cache::forget('tasksByUser_' . $task->created_by);
    }

    /**
     * Retrieve and load relationships for the specified task.
     * 
     * @param \App\Models\Task $task
     * @return Task
     */
    public function getTask(Task $task)
    {
        $task->load(['assignedTo', 'createdBy']);
        return $task;
    }

    /**
     *  Change the status of the specified task.
     * 
     * @param mixed $taskId
     * @param mixed $status
     * @return Task|Task[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function changeTaskStatus($taskId, $status)
    {
        $task = Task::findOrFail($taskId);
        $task->status = $status;
        $task->save();
        return $task;
    }
}
