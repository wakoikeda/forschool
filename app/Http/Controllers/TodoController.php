<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo; 

class TodoController extends Controller
{
    // TO-DOリストの表示
    public function index()
    {
        // $todos = Todo::all(); // すべてのTodoアイテムを取得
        // return view('todo.index', compact('todos'));
    }

    // TO-DO作成フォームの表示
    public function create()
    {
        return view('todo.create'); // create.blade.php を表示する
    }

    // TO-DOリストアイテムの保存
    public function store(Request $request)
    {
        // 入力値の検証
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        // 新しいTodoアイテムをデータベースに保存
        Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'from' => $request->input('from'),
            'to' => $request->input('to'),
        ]);

        return redirect()->route('tasks.index')->with('success', '新しいTO-DOを作成しました！');
    }
}
