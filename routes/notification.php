<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(["prefix" => "user/notification"], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notification.list');
        Route::post('/', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');
    });
});
