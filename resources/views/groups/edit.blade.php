<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Edit Group</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
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
                    <h2>Edit Group</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('groups.update', $group->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">グループ名</label>
                            <input type="text" name="name" value="{{ $group->name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">説明</label>
                            <textarea name="description" class="form-control">{{ $group->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="user_ids">メンバー</label>
                            <select name="user_ids[]" multiple class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ in_array($user->id, $group->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>

                    <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？');">削除</button>
                    </form>

                    <a href="{{ route('groups.index') }}" class="btn btn-secondary">戻る</a>
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>
</body>
</html>
