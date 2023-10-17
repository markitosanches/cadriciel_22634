<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatsController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chat', [ChatsController::class, 'index'])->name('chat');
Route::get('/messages', [ChatsController::class, 'fetchMessages'])->name('messages');
