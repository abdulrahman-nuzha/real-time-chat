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

        $friends = Friend::where('user_id',$request->user()->id)
        //->where('status','approved')
        ->with("to_user")
        ->simplePaginate(10);

        //dd(json_encode($friends));

        return view('dashboard')->with(['chats' => $friends]);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'search' => ['required', 'string', 'max:255'],
        ]);

        $query = $data["search"];

        $results = User::where('name', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")
            ->paginate(10);

        return view('users.search', [
            'results' => $results,
            'query' => $query,
        ]);
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
