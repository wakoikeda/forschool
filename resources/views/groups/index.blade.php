<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            グループ一覧
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $message }}</span>
                        </div>
                    @endif

                    <h2>グループ一覧</h2>
                    <ul class="list-group">
                        @foreach ($groups as $group)
                            <li class="list-group-item">
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
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('本当に削除しますか？')) {
                document.getElementById('form_' + id).submit();
            }
        }
    </script>
</x-app-layout>
