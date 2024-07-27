<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            三育学院中等教育学校　JAA
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="container mx-auto">
                        @if ($message = Session::get('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @endif

                        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Task</a>

                        <h3 class="text-lg font-semibold mt-4">Tasks List</h3>
                        <ul class="list-disc pl-5">
                            @foreach ($tasks as $task)
                                <li class="mb-2 bg-gray-100 p-4 rounded">
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-2">
                                            <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-500">{{ $task->title }}</a>
                                            <p>メモ: {{ $task->description }}</p>
                                            <label for="status-{{ $task->id }}" class="block text-sm font-medium text-gray-700">進捗状況:</label>
                                            <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" id="status-{{ $task->id }}" name="status" onchange="this.form.submit()">
                                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>
                                    </form>
                                    <form id="form_{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="confirmDelete({{ $task->id }});">削除</button>
                                    </form>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">編集</a>
                                </li>
                            @endforeach
                        </ul>

                        <h3 class="text-lg font-semibold mt-4">Groups List</h3>
                        <ul class="list-disc pl-5">
                            @foreach ($groups as $group)
                                <li class="mb-2 bg-gray-100 p-4 rounded">
                                    <form action="{{ route('groups.update', $group->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-2">
                                            <a href="{{ route('groups.show', $group->id) }}" class="text-blue-500">{{ $group->name }}</a>
                                        </div>
                                    </form>
                                    <form id="form_{{ $group->id }}" action="{{ route('groups.destroy', $group->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="confirmDelete({{ $group->id }});">削除</button>
                                    </form>
                                    <a href="{{ route('groups.edit', $group->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">編集</a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('groups.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Group</a>

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