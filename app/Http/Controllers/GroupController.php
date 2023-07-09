<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('users')->latest()->get();
        return view('group.index', compact('groups'));
    }

    // When user join to another group
    public function joinGroup(Group $group)
    {
        $user = auth()->user();
        $user->groups()->attach($group->id);

        return back()->with('success', "You joined $group->name successfully.");
    }

    // When user leave from specific group
    public function leaveGroup(Group $group)
    {
        $user = auth()->user();
        $user->groups()->detach($group->id);

        return back()->with('success', "You left $group->name successfully.");
    }
}
