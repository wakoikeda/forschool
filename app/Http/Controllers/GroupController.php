<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        // ログインユーザーの属するグループを取得
        $groups = Auth::user()->groups;

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $users = Auth::user()->all(); // すべてのユーザーを取得

        return view('groups.create', compact('users'));
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

        return redirect()->route('groups.index')->with('success', 'Group created successfully.');
    }

    public function show($id)
    {
        $group = Group::findOrFail($id);

        return view('groups.show', compact('group'));
    }

    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $users = User::all();

        return view('groups.edit', compact('group', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'user_ids' => 'required|array',
        ]);

        $group = Group::findOrFail($id);
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->save();

        $group->users()->sync($request->input('user_ids'));

        return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
    }
}
