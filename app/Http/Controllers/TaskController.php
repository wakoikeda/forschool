<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Group; // Groupモデルをインポート
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $groups = Group::all();
        return view('tasks.index', compact('tasks', 'groups'));
        
    }

    public function create()
    {
        $groups = Group::all(); // すべてのグループを取得
        return view('tasks.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'group_id' => 'nullable|exists:groups,id',
        ]);

        Task::create($request->only('title', 'description', 'group_id'));

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
        $groups = Group::all(); // すべてのグループを取得
        return view('tasks.edit', compact('task', 'groups'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:pending,in_progress,completed',
            'group_id' => 'nullable|exists:groups,id',
        ]);

        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->group_id = $request->input('group_id'); 
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
