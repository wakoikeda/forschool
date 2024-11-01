<x-app-layout>
    <x-slot name="header"></x-slot>
    
    <!-- Create Task and Create Group Buttons -->
    <div class="position-fixed start-0 top-50 translate-middle-y d-flex flex-column gap-2 ms-5">
        <a href="{{ route('tasks.create') }}" class="btn btn-outline-dark">Create Task</a>
        <a href="{{ route('groups.create') }}" class="btn btn-outline-dark">Create Group</a>
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
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $task->id }});">削除</button>
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
    </div>
</x-app-layout>
