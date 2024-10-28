<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Tasks</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>
    <p>This is the daily report of pending tasks:</p>
    <ol>
        @foreach($tasks as $task)
            <li>{{ $task->title }} - Due: {{ $task->due_date }}</li>
        @endforeach
    </ol>
</body>
</html>
