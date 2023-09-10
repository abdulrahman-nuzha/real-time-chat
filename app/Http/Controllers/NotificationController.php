<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    /**
     * Display a listing of user notifications.
     */
    public function index(Request $request)
    {
        $notifications = $request->user()
            ->notifications()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Modify created_at attribute to human-readable format
        $notifications->transform(function ($notification) {
            $notification->time_ago = $notification->created_at->diffForHumans();
            return $notification;
        });
        //dd(json_encode($notifications[0]));
        return view('notifications.list', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * Mark the notification as is read
     */
    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $notification = auth()->user()->notifications->find($notificationId);

        if (!$notification) {
            return back()->withErrors([['error' => 'Notification is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $notification->isRead = true;
        $notification->save();

        return redirect()->back()->with('success');
    }
}
