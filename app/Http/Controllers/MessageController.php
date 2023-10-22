<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Send new message to the user
     */
    public function create(Request $request)
    {
        //validate the message
        //make sure that the room is exist and the users also
        //send an event
        //on event Success :
        //success message

    }
}
