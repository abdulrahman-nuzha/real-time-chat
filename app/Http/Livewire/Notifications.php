<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications;
    public function render(Request $request)
    {
        $this->notifications = $request->user()
            ->unReadNotifications()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Modify created_at attribute to human-readable format
        $this->notifications->transform(function ($notification) {
            $notification->time_ago = $notification->created_at->diffForHumans();
            return $notification;
        });
        //dd(json_encode($notifications));

        //unread it notifications //modify the migration to include isSeen attribute 

        return view('livewire.notifications', ['notifications' => $this->notifications]);
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications->find($notificationId);

        if ($notification) {
            $notification->isRead = true;
            $notification->save();

            $this->notifications = auth()->user()->unReadNotifications;
        }
    }
}
