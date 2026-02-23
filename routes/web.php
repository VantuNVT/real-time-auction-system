<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// authentication routes
Route::get('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// auction routes
Route::middleware('auth')->group(function () {
    Route::get('auctions', [\App\Http\Controllers\AuctionController::class, 'index'])
        ->name('auctions.index');
    Route::get('auctions/create', [\App\Http\Controllers\AuctionController::class, 'create'])
        ->middleware('role:admin')
        ->name('auctions.create');
    Route::post('auctions', [\App\Http\Controllers\AuctionController::class, 'store'])
        ->middleware('role:admin')
        ->name('auctions.store');
    Route::get('auctions/{auction}', [\App\Http\Controllers\AuctionController::class, 'show'])
        ->name('auctions.show');
    Route::post('auctions/{auction}/bid', [\App\Http\Controllers\AuctionController::class, 'bid'])
        ->name('auctions.bid');
});
