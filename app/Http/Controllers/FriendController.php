<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    /**
     * Display a listing of user friends.
     */
    public function index(Request $request)
    {
        $friends = Friend::where('user_id',$request->user()->id)
        //->where('status','approved')
        ->with("to_user")
        ->simplePaginate(10);

        return view('friends.list', [
            'friends' => $friends,
        ]);
    }

    // /**
    //  * Dispaly friend info
    //  */
    // public function friendProfile(){
    //     return view('profile.partials.profile-card');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
