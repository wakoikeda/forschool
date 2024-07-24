<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Task Details</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>Task Details</h1>
    <p><strong>タイトル:</strong> {{ $task->title }}</p>
    <p><strong>メモ:</strong> {{ $task->description }}</p>
    <p><strong>進捗状況:</strong> {{ $task->status }}</p>
    <p><strong>期限:</strong> {{ $task->due_date }}</p>
    <p><strong>優先度:</strong> {{ $task->priority }}</p>
    <p><strong>作成日時:</strong> {{ $task->created_at }}</p>
    <p><strong>更新日時:</strong> {{ $task->updated_at }}</p>
    <a href="{{ route('tasks.index') }}">タスク一覧に戻る</a>
</body>
</html>
