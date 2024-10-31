<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>グループ作成</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <x-app-layout>


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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4FVAAZ2LRR8UQQ1nrV+8F3BlzE1ANdGx6LOhGdiZNd0/l8P" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG81rKh0W5n0e5ZR2g1Ra1bb1gE0M5wJkFp1MGm7c6twXgAw1pHp+0KS9Km" crossorigin="anonymous"></script>
</body>
</html>
