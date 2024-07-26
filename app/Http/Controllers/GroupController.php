<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User; // Userモデルをインポート
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function create()
    {
        $users = User::all(); // すべてのユーザーを取得
        return view('groups.create', compact('users')); // ビューにユーザーを渡す
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'user_ids' => 'required|array',
        ]);

        $group = Group::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
        ]);

        $group->users()->attach($request->input('user_ids'));

        return redirect()->route('tasks.index')->with('success', 'Group created successfully.');
    }
}
