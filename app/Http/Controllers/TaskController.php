<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Exception;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = $this->taskService->listAllTasks($request->user());

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Task::class);
        $users = User::all();

        return view('tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);

        try {
            $validated = $request->validated();
            $this->taskService->createTask($validated);
            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to create task.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $this->taskService->getTask($task);

        return view('tasks.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $task = $this->taskService->getTask($task);
        $users = User::all();

        return view('tasks.edit')->with(['task' => $task, 'users' => $users,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        try {
            $validated = $request->validated();
            $this->taskService->updateTask($task, $validated);
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to update task.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        try {
            $this->taskService->deleteTask($task);
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete task.']);
        }
    }

    /**
     * Show the form for change status of the specified resource.
     */
    public function showChangeStatus(Task $task)
    {
        $this->authorize('changeStatus', $task);
        $task = $this->taskService->getTask($task);

        return view('tasks.changeStatus', compact('task'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function changeStatus(Request $request, Task $task)
    {
        $this->authorize('changeStatus', $task);

        try {
            $this->taskService->changeTaskStatus($task->id, $request->input('status'));
            return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to change task status.']);
        }
    }
}
