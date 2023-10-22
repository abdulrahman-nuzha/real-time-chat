<?php

namespace App\Http\Middleware;

use App\Models\Room;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roomId = $request->route('room_id');
        $room = Room::find($roomId);

        if (!$room) {
            return back()->withErrors([['error' => 'Chat is not exist'], Response::HTTP_NOT_FOUND]);
        }
        if ($room->user_id_1 != auth()->user()->id && $room->user_id_2 != auth()->user()->id) {
            abort(403, 'Access denied');
            //return response()->json(['message' => 'Access denied'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
