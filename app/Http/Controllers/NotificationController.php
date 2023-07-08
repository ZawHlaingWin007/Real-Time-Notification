<?php

namespace App\Http\Controllers;

use App\Events\StudentJoinedGroupNotificationEvent;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('real-time-notification.index');
    }

    public function sendNotification()
    {
        $notification = [
            'message' => 'New notification!'
        ];

        event(new StudentJoinedGroupNotificationEvent($notification));
        
        return response()->json([
            'success' => true
        ]);
    }
}
