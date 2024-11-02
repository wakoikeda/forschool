<?php

namespace App\Http\Controllers;

use App\Models\Group; // Groupモデルをインポート
use App\Models\Task;
use App\Models\Todo; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // ログインユーザーの所属グループを取得
        $groups = Auth::user()->groups;

        // グループごとのタスクを取得
        $tasksByGroup = [];
        foreach ($groups as $group) {
            $tasksByGroup[$group->name] = Task::where('group_id', $group->id)->get();
        }
       
        
        $todos = Todo::all();

        return view('tasks.index', compact('tasksByGroup', 'groups','todos'));
    }

    public function create()
    {
        // ログインユーザーの所属グループを取得
        $groups = Auth::user()->groups;

        return view('tasks.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'group_id' => 'nullable|exists:groups,id',
        ]);

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'group_id' => $request->input('group_id'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $groups = Auth::user()->groups;

        return view('tasks.edit', compact('task', 'groups'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'group_id' => 'nullable|exists:groups,id',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->group_id = $request->input('group_id');
        $task->status = $request->input('status');
         dd($task->status); 
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
