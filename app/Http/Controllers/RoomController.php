<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use stdClass;

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
    public function show(Request $request, $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return back()->withErrors([['error' => 'Chat is not exist'], Response::HTTP_NOT_FOUND]);
        }

        $perPage = 10; // Number of messages per page
        $page = $room->messages->count() / $perPage;

        //define an object to set the necessary data only 
        $data = new stdClass();

        $data->messages = $room->messages()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        //dd(json_encode($messages, JSON_PRETTY_PRINT));

        //check if there is not messages //new chat
        if ($data->messages->isEmpty()) {
            $data->messages = [];
            return view('room.index')->with(['data' => $data]);
        }

        auth()->user()->id === $data->messages[0]->sender->id ?
            $data->user = $data->messages[0]->receiver
            : $data->user = $data->messages[0]->sender;

        //unset the unnecessary data
        unset($data->user->email);
        unset($data->messages[0]->sender);

        //dd(json_encode($data, JSON_PRETTY_PRINT));
        if ($request->ajax()) {
            return response()->json(['data' => $data]);
        }
        
        return view('room.index')->with(['data' => $data]);
    }
}
