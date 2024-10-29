<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title ?? '') }}" required>
    @error('title')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select" required>
        <option value="pending" {{ (old('status', $task->status ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
        <option value="completed" {{ (old('status', $task->status ?? '') == 'completed') ? 'selected' : '' }}>Completed</option>
    </select>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="due_date" class="form-label">Due Date</label>
    <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d') ?? '') }}">
    @error('due_date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="assigned_to" class="form-label">Assign To</label>
    <select name="assigned_to" id="assigned_to" class="form-select">
        <option value="">Unassigned</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ (old('assigned_to', $task->assigned_to ?? '') == $user->id) ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    @error('assigned_to')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
