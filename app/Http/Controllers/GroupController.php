<?php

namespace App\Http\Controllers;

use App\Events\GroupJoined;
use App\Events\GroupJoinedNotificationEvent;
use App\Events\GroupMembershipChanged;
use App\Events\GroupNotification;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

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

        // Trigger the group notification event
        // Event::dispatch(new GroupNotification($user, 'New member joined the group!'));
        // GroupMembershipChanged::dispatch($group);
        broadcast(new GroupJoinedNotificationEvent($group, $user));

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
