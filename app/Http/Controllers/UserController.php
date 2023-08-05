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

        $friends = Friend::where('user_id', $request->user()->id)
            //->where('status','approved')
            ->with("to_user")
            ->simplePaginate(10);

        //dd(json_encode($friends));

        return view('dashboard')->with(['chats' => $friends]);
    }

    public function search(Request $request)
    {
        return view('search');
        // $data = $request->validate([
        //     'search' => ['required', 'string', 'max:255'],
        // ]);

        // $query = $data["search"];

        // $results = User::where('name', 'LIKE', "%$query%")
        //     ->orWhere('username', 'LIKE', "%$query%")
        //     ->paginate(10);

        // return view('users.search', [
        //     'results' => $results,
        //     'query' => $query,
        // ]);
    }


    // app/Http/Controllers/UserController.php

    public function profile($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // Handle user not found
        }

        $isOwnProfile = $user->id === Auth::id(); // Check if it's the logged-in user's profile

        // Handle the user profile logic and return the view
        return view('profile.profile', ['user' => $user, 'isOwnProfile' => $isOwnProfile]);
    }
}
