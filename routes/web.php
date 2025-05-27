<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('games.index');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rota Games
Route::middleware('auth')->prefix('/games')->group(function() {
    Route::get("/", [GameController::class, 'index'])->name('games.index');
    Route::get("/register", [GameController::class, 'create'])->name('games.register');
    Route::get("/{game}/edit", [GameController::class, 'edit'])->name('games.edit');
    Route::put("/{game}", [GameController::class, 'update'])->name('games.update');

    Route::get("/{game}", [GameController::class, 'show'])->name('games.show');
    
    Route::delete("/{game}", [GameController::class, 'destroy'])->name('games.destroy');
    Route::post("/register", [GameController::class, 'store'])->name('games.store');
});

require __DIR__.'/auth.php';
