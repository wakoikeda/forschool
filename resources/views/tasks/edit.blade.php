<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Edit Task</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            三育学院中等教育学校　JAA
        </h1>
    </x-slot>
    <h2>Edit Task</h2>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" value="{{ $task->title }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">メモ</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">進捗状況</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="form-group">
            <label for="group_id">グループ:</label>
            <select name="group_id" class="form-control">
                <option value="">選択してください</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $task->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
    </x-app-layout>
</body>
</html>
