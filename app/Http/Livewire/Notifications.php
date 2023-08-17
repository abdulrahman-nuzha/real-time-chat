<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class Notifications extends Component
{
    public function render(Request $request)
    {
        $notifications = $request->user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Modify created_at attribute to human-readable format
        $notifications->transform(function ($notification) {
            $notification->time_ago = $notification->created_at->diffForHumans();
            return $notification;
        });
        //dd(json_encode($notifications));

        //unread it notifications //modify the migration to include isSeen attribute 

        return view('livewire.notifications', ['notifications' => $notifications]);
    }
}
