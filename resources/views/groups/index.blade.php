<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Group List</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Bootstrap CSS (必要に応じて追加) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            margin: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
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

                            <h2>Group List</h2>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        function confirmDelete(id) {
            if (confirm('本当に削除しますか？')) {
                document.getElementById('form_' + id).submit();
            }
        }
    </script>
</body>
</html>