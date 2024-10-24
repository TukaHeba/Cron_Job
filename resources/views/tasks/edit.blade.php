@extends('layouts.app')

@section('content')
@php
    $formTitle = 'Edit Task';
    $formAction = route('tasks.update', $task->id);
    $buttonText = 'Update';
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $formTitle }}</div>

                <div class="card-body">
                    <form action="{{ $formAction }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('tasks.form')

                        <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
