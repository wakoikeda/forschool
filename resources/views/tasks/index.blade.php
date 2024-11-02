<x-app-layout>
    <x-slot name="header"></x-slot>
    
    <!-- Create Task and Create Group Buttons -->
    <div class="position-fixed start-0 top-50 translate-middle-y d-flex flex-column gap-2 ms-5">
        <a href="{{ route('tasks.create') }}" class="btn btn-outline-dark">Create Task</a>
        <a href="{{ route('groups.create') }}" class="btn btn-outline-dark">Create Group</a>
        <a href="{{ route('todo.create')}}" class ="btn btn-outline-dark">TO-DO作成</a>
    </div>

    <div class="container mt-4" style="max-width: 60vw;">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        @foreach ($tasksByGroup as $groupName => $tasks)
            <div class="task-group my-4">
                <h3 class="task-group-title text-center mb-3">{{ $groupName }}</h3>
                <div class="row">
                    @foreach ($tasks as $task)
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                                    <a href="{{ route('tasks.show', $task->id) }}" class="task-title h5 mb-2 text-decoration-none text-white">{{ $task->title }}</a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                    </form>
                                    <p class="card-text">メモ: {{ $task->description }}</p>
                                    <div class="d-flex justify-content-between">
                                        <form id="form_{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $task->id }});">完了</button>
                                        </form>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-warning">編集</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        
         @foreach ($todos as $todo)
    <div class="todo-item mt-5">
        <h2>{{ $todo->title }}</h2>
        <p>{{ $todo->description }}</p>
        <p>開始日: {{ $todo->from }}</p>
        <p>終了日: {{ $todo->to }}</p>

        <!-- グリッド生成 -->
        <div class="row row-cols-auto" style="max-width: 100%;">
            @php
                $fromDate = new DateTime($todo->from);
                $toDate = new DateTime($todo->to);
                $interval = $fromDate->diff($toDate)->days + 1;
            @endphp

            @for ($i = 1; $i <= $interval; $i++)
                <div class="col border p-3 text-center">
                    Day {{ $i }}
                </div>
            @endfor
        </div>
    </div>
@endforeach
</div>

    </div>
</x-app-layout>
