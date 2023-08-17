<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(["prefix" => "friend"], function () {
        Route::get('/', [FriendController::class, 'index'])->name('friend.list');
        Route::post('/', [FriendController::class, 'create'])->name('friend.add');
        Route::post('/accept', [FriendController::class, 'accept'])->name('friend.accept');
        Route::post('/reject', [FriendController::class, 'reject'])->name('friend.reject');
        Route::get('/requests', [FriendController::class, 'friendsRequests'])->name('friend.requests');
    });
});
