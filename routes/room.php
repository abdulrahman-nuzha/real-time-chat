<?php

use App\Http\Controllers\RoomController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(["prefix" => "user/chat"], function () {
        Route::get('/dashboard', [RoomController::class, 'index'])->name('dashboard');
        Route::get('/{room_id}', [RoomController::class, 'show'])->name('room.show')
            ->middleware(['roomAuthorization']);
    });
});
