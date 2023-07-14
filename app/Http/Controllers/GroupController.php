<?php

namespace App\Http\Controllers;

use App\Events\UserJoinedGroup;
use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('users')->latest()->get();
        return view('group.index', compact('groups'));
    }

    public function show(Group $group)
    {
        return view('group.show', compact('group'));
    }

    public function allGroups()
    {
        $groups = Group::with('users')->latest()->get();
        return response()->json([
            'groups' => $groups
        ]);
    }

    // When user join to another group
    public function joinGroup(Group $group)
    {
        $user = auth()->user();
        $user->groups()->attach($group->id);

        // Event::dispatch(new GroupJoined($group, $user));
        // GroupMembershipChanged::dispatch($group);

        broadcast(new UserJoinedGroup($user, $group))->toOthers();

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
