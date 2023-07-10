<?php

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('group.{groupId}', function ($user, $groupId) {
    // $group = Group::find($groupId);
    // return $group->users->contains('id', $user->id);
    // return Gate::allows('access-group', [$user, $groupId]);
    return true;
});

// Broadcast::channel('group.{groupId}', function ($user, $groupId) {
//     // Add logic to check if the user belongs to the group
//     $group = Group::findOrFail($groupId);
//     return Auth::check() && $group->users->contains('id', $user->id);
// });

// Broadcast::channel('notifications.{userId}', function ($user, $userId) {
//     return (int) $user->id === (int) $userId || $user->id === 7;
// });
