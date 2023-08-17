<?php

namespace App\Http\Controllers;

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
        $notification->user_id = $request->user()->id;
        $notification->title = "Accept Your Friend Request";
        $notification->body = $user->name . " Accept your friend request.";
        $notification->save();

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
            'user_id_2' => $request->user()->id,
            'status' => "pending"
        ])->first();

        if (!$friend) {
            return back()->withErrors([['error' => 'Friend Request is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $friend->update([
            'status' => "rejected"
        ]);

        $notification = new Notification();
        $notification->user_id = $request->user()->id;
        $notification->title = "Reject Your Friend Request";
        $notification->body = $user->name . " Reject your friend request.";
        $notification->save();

        return redirect()->back()->with('success', 'Friend Request Approved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
