<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FriendController extends Controller
{
    /**
     * Display a listing of user friends.
     */
    public function index(Request $request)
    {
        $friends = $request->user()
            ->approvedFriends();

        return view('friends.list', [
            'friends' => $friends,
        ]);
    }

    /**
     * Display a listing of user friends requests.
     */
    public function friendsRequests(Request $request)
    {
        $friends = $request->user()
            ->friendsRequests()->paginate();

        return view('friends.requests', [
            'friends' => $friends,
        ]);
    }

    /**
     * Send freind request to the user
     */
    public function create(Request $request)
    {
        $toUserId = $request->input('user_id');
        $user = User::find($toUserId);

        if (!$user) {
            return back()->withErrors([['error' => 'User is not exist'], Response::HTTP_NOT_FOUND]);
        }
        $friendStatus = $user->areFriends(auth()->user());
        if ($friendStatus) {
            return back()->withErrors(['error' => 'Users already friends']);
        }

        $friend = new Friend();
        $friend->user_id_1 = auth()->user()->id;
        $friend->user_id_2 = $toUserId;
        $friend->status = "pending";
        $friend->save();

        $notification = new Notification();
        $notification->user_id = $toUserId;
        $notification->title = "New Friend Request";
        $notification->body = $request->user()->name . " Send you a friend request.";
        $notification->save();

        event(new NewNotification($notification, $user));

        return redirect()->back()->with('success', 'Request Sent Successfully');
    }


    /**
     * accept the friend request
     */
    public function accept(Request $request)
    {
        $toUserId = $request->input('user_id');

        $user = User::find($toUserId);
        if (!$user) {
            return back()->withErrors([['error' => 'User is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friendStatus = $user->areFriends(auth()->user());
        if (!$friendStatus) {
            return back()->withErrors(['error' => 'You Should Send Friend Request First']);
        }

        if ($friendStatus != "pending") {
            return back()->withErrors(['error' => 'There`s Not a Friend Request']);
        }
        $friend = Friend::where([
            'user_id_1' => $user->id,
            'user_id_2' => $request->user()->id,
            'status' => "pending"
        ])->first();

        if (!$friend) {
            return back()->withErrors([['error' => 'Friend Request is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friend->update([
            'status' => "approved"
        ]);

        $notification = new Notification();
        $notification->user_id = $user->id;
        $notification->title = "Accepted Your Friend Request";
        $notification->body = auth()->user()->name . " Accepted your friend request.";
        $notification->save();

        event(new NewNotification($notification, $user));

        return redirect()->back()->with('success', 'Friend Request Approved Successfully');
    }

    /**
     * reject the friend request
     */
    public function reject(Request $request)
    {
        $toUserId = $request->input('user_id');

        $user = User::find($toUserId);
        if (!$user) {
            return back()->withErrors([['error' => 'User is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friendStatus = $user->areFriends(auth()->user());
        if (!$friendStatus) {
            return back()->withErrors(['error' => 'You Should Send Friend Request First']);
        }

        if ($friendStatus != "pending") {
            return back()->withErrors(['error' => 'There`s Not a Friend Request']);
        }

        $friend = Friend::where([
            'user_id_1' => $user->id,
            'user_id_2' => $request->user()->id,
            'status' => "pending"
        ])->first();

        if (!$friend) {
            return back()->withErrors([['error' => 'Friend Request is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friend->update([
            'status' => "rejected"
        ]);

        // $notification = new Notification();
        // $notification->user_id = $user->id;
        // $notification->title = "Rejected Your Friend Request";
        // $notification->body = auth()->user()->id . " Rejected your friend request.";
        // $notification->save();

        // event(new NewNotification($notification, $user));

        return redirect()->back()->with('success', 'Friend Request Approved Successfully');
    }

    /**
     * Remove the friendship.
     */
    public function destroy(Request $request)
    {
        $userId = $request->input('user_id');
        //remove user friend request
        $user = User::find($userId);

        if (!$user) {
            return back()->withErrors([['error' => 'User is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friendStatus = $user->areFriends(auth()->user());
        if (!$friendStatus) {
            return back()->withErrors(['error' => 'You Should Send Friend Request First']);
        }

        if ($friendStatus != "approved") {
            return back()->withErrors(['error' => 'You Should Be Friends First']);
        }

        $friend = Friend::where(
            function ($query) use ($user) {
                $query
                    ->where('user_id_1', auth()->user()->id)
                    ->where('user_id_2', $user->id)
                    ->orWhere('user_id_1', $user->id)
                    ->where('user_id_2', auth()->user()->id);
            }
        )->first();

        if (!$friend) {
            return back()->withErrors([['error' => 'Friend Request is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friend->delete();

        //!should delete the notification also
        //!but first find a way to know which notification exactly should I delete
        return redirect()->back()->with('success', 'Friend Request Removed Successfully');
    }

    /**
     * Remove the friend request.
     */
    public function remove(Request $request)
    {
        $userId = $request->input('user_id');
        //remove user friend request
        $user = User::find($userId);

        if (!$user) {
            return back()->withErrors([['error' => 'User is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friendStatus = $user->areFriends(auth()->user());
        if (!$friendStatus) {
            return back()->withErrors(['error' => 'You Should Send Friend Request First']);
        }

        $friend = Friend::where([
            'user_id_1' => auth()->user()->id,
            'user_id_2' => $user->id
        ])->first();

        if (!$friend) {
            return back()->withErrors([['error' => 'Friend Request is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friend->delete();

        //!should delete the notification also
        //!but first find a way to know which notification exactly should I delete

        return redirect()->back()->with('success', 'Friend Request Removed Successfully');
    }
}
