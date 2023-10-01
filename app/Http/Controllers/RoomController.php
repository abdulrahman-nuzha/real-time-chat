<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomController extends Controller
{
    function index(Request $request)
    {
        $rooms = $request->user()->rooms();
        return view('dashboard')->with(['rooms' => $rooms]);
    }

    /**
     * Display the specified room.
     */
    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return back()->withErrors([['error' => 'Chat is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $messages = $room->messages;
        foreach ($messages as $message) {
            $message->sender;
        }


        //dd(json_encode($messages));

        return view('room.index')->with(['messages' => $messages]);
    }
}
