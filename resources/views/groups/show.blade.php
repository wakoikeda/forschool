<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>グループ詳細</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            グループ詳細
        </h1>
    </x-slot>

    <h2>Group Details</h2>
    <p>グループ名: {{ $group->name }}</p>
    <p>説明: {{ $group->description }}</p>

    <h3>メンバー一覧</h3>
    <ul>
        @foreach ($group->users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('groups.index') }}">戻る</a>
    </x-app-layout>
</body>
</html>
