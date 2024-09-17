
<x-app-layout>
    <x-slot name="header">
        <h1 class="header-title">
            三育学院中等教育学校 JAA
        </h1>
    </x-slot>

    <div class="container">
        <div class="content-wrapper">
            <div class="box">
                <div class="inner-box">
                    <div class="container">
                        @if ($message = Session::get('success'))
                            <div class="success-message" role="alert">
                                <span>{{ $message }}</span>
                            </div>
                        @endif

                        <a href="{{ route('tasks.create') }}" class="create-button">Create Task</a>

                        @foreach ($tasksByGroup as $groupName => $tasks)
                            <div class="task-group">
                                <h3 class="task-group-title">{{ $groupName }}</h3>
                                <ul class="task-list">
                                    @foreach ($tasks as $task)
                                        <li class="task-item">
                                            <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <div class="task-details">
                                                    <a href="{{ route('tasks.show', $task->id) }}" class="task-title">{{ $task->title }}</a>
                                                    <p class="task-description">メモ: {{ $task->description }}</p>
                                                    <label for="status-{{ $task->id }}" class="status-label">進捗状況:</label>
                                                    <select id="status-{{ $task->id }}" name="status" class="status-select" onchange="this.form.submit()">
                                                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </div>
                                            </form>
                                            <form id="form_{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-button" onclick="confirmDelete({{ $task->id }});">削除</button>
                                            </form>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="edit-button">編集</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                        <h3 class="groups-title">Groups List</h3>
                        <ul class="group-list">
                            @foreach ($groups as $group)
                                <li class="group-item">
                                    <form action="{{ route('groups.update', $group->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <div class="group-details">
                                            <a href="{{ route('groups.show', $group->id) }}" class="group-name">{{ $group->name }}</a>
                                        </div>
                                    </form>
                                    <form id="form_{{ $group->id }}" action="{{ route('groups.destroy', $group->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-button" onclick="confirmDelete({{ $group->id }});">削除</button>
                                    </form>
                                    <a href="{{ route('groups.edit', $group->id) }}" class="edit-button">編集</a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('groups.create') }}" class="create-button">Create Group</a>

                        <script>
                            function confirmDelete(id) {
                                if (confirm('本当に削除しますか？')) {
                                    document.getElementById('form_' + id).submit();
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
