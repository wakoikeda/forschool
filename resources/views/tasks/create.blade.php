<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>タスク作成</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>タスク作成</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="title" placeholder="タスク名"/><br>
            <input type="text" name="description" placeholder="メモ"/><br>
            <label for="group_id">グループ:</label>
            <select name="group_id" id="group_id" class="form-control">
                <option value="">選択してください</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">作成</button>
    </form>
</body>
</html>
