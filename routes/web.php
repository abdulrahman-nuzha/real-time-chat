<?php

use App\Events\NewNotification;
use App\Http\Controllers\ProfileController;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $notification = Notification::first();
    $us = auth()->user();
    event(new NewNotification($notification, $us));
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/friend.php';
require __DIR__ . '/notification.php';
require __DIR__ . '/room.php';
