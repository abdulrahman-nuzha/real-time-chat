<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    function index(Request $request)
    {
        $rooms = $request->user()->rooms();
        //dd(json_encode($rooms));
        return view('dashboard')->with(['rooms' => $rooms]);
    }
}
