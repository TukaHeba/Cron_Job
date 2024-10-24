@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table" style="table-layout: fixed; width: 100%;">
                            <thead>
                              <tr>
                                <th scope="col" style="width: 20px;">#</th> 
                                <th scope="col" style="width: 120px;">Title</th>
                                <th scope="col" style="width: 150px;">Description</th>
                                <th scope="col" style="width: 70px;">Status</th>
                                <th scope="col" style="width: 90px; white-space: nowrap;">Due Date</th>
                                <th scope="col" style="width: 70px; white-space: nowrap;">Assigned To</th>
                                <th scope="col" style="width: 70px; white-space: nowrap;">Created By</th>
                                <th scope="col" style="width: 180px;">Actions</th> 
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>{{ $task->due_date ?? 'Not Defined Yet' }}</td>
                                    <td>{{ $task->assignedTo ? $task->assignedTo->name : 'Unassigned' }}</td>
                                    <td>{{ $task->createdBy->name }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Task Actions">
                                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-outline-dark">SHOW</a>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-success">EDIT</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger">DELETE</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
