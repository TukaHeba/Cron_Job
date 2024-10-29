<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Policy of who can view a specific task.
     * 
     * Admin can view any task, while other users can view only tasks assigend to them.
     * 
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return bool
     */
    public function view(User $user, Task $task)
    {
        return $user->is_admin || $user->id === $task->assigned_to;
    }

    /**
     * Policy of who can create a new task.
     * 
     * Only admins can create tasks.
     * 
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Policy of who can update a specific task.
     * 
     * Only admins can update tasks.
     * 
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        return $user->is_admin;
    }

    /**
     * Policy of who can delete a specific task.
     * 
     * Only admins can delete tasks.
     * 
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        return $user->is_admin;
    }

    /**
     * Policy of who can change the status of a specific task.
     * 
     * Admin can change it for any task, while other users can only if tasks assigend to them.
     * 
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return bool
     */
    public function changeStatus(User $user, Task $task)
    {
        return $user->is_admin || $user->id === $task->assigned_to;
    }
}
