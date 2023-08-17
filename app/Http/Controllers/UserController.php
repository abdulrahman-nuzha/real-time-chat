<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of user chats.
     //should be in chat controller but it here jsut for testing the design
     */
    public function index(Request $request)
    {
        // $users = [
        //     [
        //         'id' => '1',
        //         'name' => 'John Doe',
        //         'status' => 'offline',
        //         'profile_picture' => env('APP_STORAGE') . 'user.png',
        //     ],
        //     [
        //         'id' => '2',
        //         'name' => 'Jane Smith',
        //         'status' => 'online',
        //         'profile_picture' => env('APP_STORAGE') . 'user.png',
        //     ],
        //     [
        //         'id' => '3',
        //         'name' => 'Smith Smith',
        //         'status' => 'online',
        //         'profile_picture' => env('APP_STORAGE') . 'user.png',
        //     ],
        // ];

        // $friends = Friend::where('user_id', $request->user()->id)
        //     //->where('status','approved')
        //     ->with("to_user")
        //     ->simplePaginate(10);
        $friends = $request->user()->friends();
        // dd(json_encode($friends));
        return view('dashboard')->with(['chats' => $friends]);
    }

    public function search(Request $request)
    {
        return view('search');
    }

    public function profile($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // Handle user not found
        }

        $isOwnProfile = $user->id === Auth::id(); // Check if it's the logged-in user's profile
        //check if two users are friends
        // $friendStatus = Friend::where('user_id', auth()->user()->id)
        //     ->where('to_user_id', $user)->get();
        // $friendStatus =   $user->friends()->where('user_id', auth()->user()->id)->exists();
        // dd($user->friends());
        // dd(json_decode($friendStatus));
        // if ($friendStatus) {
        //     $friendStatus = $friendStatus->status;
        // } else {
        //     $friendStatus = false;
        // }
        $friendStatus = "";
        if (!$isOwnProfile) {
            $friendStatus = $user->areFriends(auth()->user());
        }
        //dd(auth()->user()->id . "    " . $user->id);
        return view('profile.profile', [
            'user' => $user,
            'isOwnProfile' => $isOwnProfile,
            'friendStatus' => $friendStatus,
        ]);
    }
}
