<?php

use App\View\Pages\Game;
use App\View\Pages\Home;
use App\View\Pages\Join;
use App\View\Pages\PreGame;
use App\View\Pages\Preplay;
use App\View\Pages\Session;
use App\View\Pages\AdminGame;
use App\View\Pages\Fin;
use App\View\Pages\SessionStart;
use Illuminate\Support\Facades\Route;

Route::namespace("App\View\Pages")->group(function(){
    // Route Guest
    Route::get('/',Home::class)->middleware('guest')->name("home");

    // Route Joueure 
    Route::get('/join',Join::class)->name("join");
    Route::get('/join/pre-game/{sessionId}/start', PreGame::class)->name('game.preplay');
    Route::get('/join/{playerId}/game/{sessionId}/waiting', Preplay::class)->name('game.waiting');
    Route::get('/join/{playerId}/game/{sessionId}', Game::class)->name('game.play');

    // Route Maitre de jeu /admin/
    Route::middleware('auth')->group(function () {
        Route::get('/admin/session/start_new', SessionStart::class)->name('session.start');
        Route::get('/admin/session/{sessionId}/waiting', Session::class)->name('session.waiting');
        Route::get('/admin/session/{sessionId}', AdminGame::class)->name('session.active');
    });
    Route::get('/join/{playerId}/game/{sessionId}/fin', Fin::class)->name('game.fin');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/join/dashboard', function () { return view('dashboard');})->name('dashboard');
});
