@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Task Details') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>Title:</strong>
                        <p>{{ $task->title }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p>{{ $task->description }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Status:</strong>
                        <p>{{ $task->status }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Due Date:</strong>
                        <p>{{ $task->due_date ?? 'Not Defined Yet' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Assigned To:</strong>
                        <p>{{ $task->assignedTo ? $task->assignedTo->name : 'Unassigned' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Created By:</strong>
                        <p>{{ $task->createdBy->name }}</p>
                    </div>

                    <div class="btn-group" role="group" aria-label="Task Actions">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
