<?php

use App\View\Pages\Home;
use App\View\Pages\Join;
use App\View\Pages\Preplay;
use App\View\Pages\Session;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::namespace("App\View\Pages")->group(function(){
    Route::get('/',Home::class)->middleware('guest')->name("home");

    Route::get('/join',Join::class)->name("join");
    Route::get('/join/pregame', Preplay::class)->name('game.preplay');

    Route::get('/session/{sessionId}/waiting', Session::class)->name('session.waiting');


});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/join/dashboard', function () { return view('dashboard');})->name('dashboard');
});
