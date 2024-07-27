<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            三育学院中等教育学校　JAA
        </h1>
        <h2>{{ Auth::user()->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="container">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <a href="{{ route('tasks.create') }}" class="btn btn-custom">Create Task</a>

                        <h3>Tasks List</h3>
                        <ul class="list-group">
                            @foreach ($tasks as $task)
                                <li class="list-group-item">
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                            <p>メモ: {{ $task->description }}</p>
                                            <label for="status-{{ $task->id }}">進捗状況:</label>
                                            <select class="form-control" id="status-{{ $task->id }}" name="status" onchange="this.form.submit()">
                                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>
                                    </form>
                                    <form id="form_{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $task->id }});">削除</button>
                                    </form>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info">編集</a>
                                </li>
                            @endforeach
                        </ul>

                        <h3>Groups List</h3>
                        <ul class="list-group">
                            @foreach ($groups as $group)
                                <li class="list-group-item">
                                    <form action="{{ route('groups.update', $group->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <a href="{{ route('groups.show', $group->id) }}">{{ $group->name }}</a>
                                        </div>
                                    </form>
                                    <form id="form_{{ $group->id }}" action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $group->id }});">削除</button>
                                    </form>
                                    <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-info">編集</a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('groups.create') }}" class="btn btn-custom">Create Group</a>

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
`
