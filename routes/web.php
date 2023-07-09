<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [NotificationController::class, 'index'])->name('notification.index');
Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('notification.sendNotification');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/join-group/{group}', [GroupController::class, 'joinGroup'])->name('groups.joinGroup');
Route::get('/leave-group/{group}', [GroupController::class, 'leaveGroup'])->name('groups.leaveGroup');
Route::resource('groups', GroupController::class);