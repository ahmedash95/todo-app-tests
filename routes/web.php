<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TwitterConnectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes();
});

Route::redirect('/','todo');
Route::middleware('auth')->group(function() {
    Route::resource('/todo',TodoController::class);
    Route::get('/connect/twitter', [TwitterConnectController::class,'connect'])->name('connect.twitter');
    Route::get('connect/twitter/callback', [TwitterConnectController::class,'callback'])->name('connect.twitter.callback');
});

