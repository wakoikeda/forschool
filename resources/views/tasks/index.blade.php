<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>for school app</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>School app</h1>
        <div class="container">
        <h2>Laravel Task App</h2>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <form action="{{ route('tasks.store') }}" method="POST">
     @csrf
        <div class="form-group">
            <input type="text" name="title" placeholder="タスク名"/><br>
           <input type="text" name="description" placeholder="メモ"/><br>
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
       <h3>Tasks List</h3>
    <ul class="list-group">
        @foreach ($tasks as $task)
     
            <li class="list-group-item">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <p>タイトル: {{ $task->title }}</p>
                        <p>メモ: {{ $task->description }}</p>
                        
                        <label for="status-{{ $task->id }}">進捗状況:</label>
                        <select class="form-control" id="status-{{ $task->id }}" name="status" onchange="this.form.submit()">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <!-- 削除ボタン -->
                             <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline">
                            @csrf
                        　 @method('DELETE')
       　　　　　　　　　　　　 <button type="submit" class="btn btn-danger">削除</button>
   　　　　　　　　　　　　　　 </form>
                    </div>
                </form>
            </li>
        @endforeach
    </ul>
</div>
　　</div>
    </body>
</html>