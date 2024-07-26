<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>グループ作成</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>グループ作成</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="グループ名"/><br>
            <input type="text" name="description" placeholder="説明"/><br>
        </div>
        <div class="form-group">
            <label for="user_ids">ユーザーを選択:</label>
            <select name="user_ids[]" id="user_ids" class="form-control" multiple>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">作成</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</body>
</html>
