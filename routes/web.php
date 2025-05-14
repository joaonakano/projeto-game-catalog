<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rota Games
Route::prefix('/games')->group(function() {
    Route::get("/");
    Route::get("/register");
    Route::get("/{uuid}")->whereUuid('uuid');
    Route::put("/{uuid}")->whereUuid('uuid');
    Route::delete("/{uuid}")->whereUuid('uuid');
    Route::post("/register");
});

require __DIR__.'/auth.php';
