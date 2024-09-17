<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Task Details</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4FVAAZ2LRR8UQQ1nrV+8F3BlzE1ANdGx6LOhGdiZNd0/l8P" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG81rKh0W5n0e5ZR2g1Ra1bb1gE0M5wJkFp1MGm7c6twXgAw1pHp+0KS9Km" crossorigin="anonymous"></script>
</body>
</html>
