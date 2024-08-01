<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>グループ作成</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
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
                                <input type="text" name="name" placeholder="グループ名" class="form-control"/><br>
                                <input type="text" name="description" placeholder="説明" class="form-control"/><br>
                                <label for="user_ids">メンバー選択:</label>
                                <div>
                                    @foreach($users as $user)
                                        <label>
                                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </label><br>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">作成</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
