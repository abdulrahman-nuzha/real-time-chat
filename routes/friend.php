<?php


use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(["prefix" => "user/friend"], function () {
        Route::get('/', [FriendController::class, 'index'])->name('friend.list');
        Route::post('/', [FriendController::class, 'create'])->name('friend.add');
        Route::delete('/', [FriendController::class, 'destroy'])->name('friend.destroy');
        Route::delete('/remove', [FriendController::class, 'remove'])->name('friend.remove');
        Route::post('/accept', [FriendController::class, 'accept'])->name('friend.accept');
        Route::post('/reject', [FriendController::class, 'reject'])->name('friend.reject');
        Route::get('/requests', [FriendController::class, 'friendsRequests'])->name('friend.requests');
    });
});
