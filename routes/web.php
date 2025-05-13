<?php

use Illuminate\Support\Facades\Route;

// Rotas do projeto

// Rotas Simples
Route::get("/");
Route::get("/login");
Route::get("/user");
Route::get("/dashboard");

// Rota de Registro de Usuario
Route::prefix('/register')->group(function() {
    Route::get("/");
    Route::post("/");
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

// Rota Users
Route::prefix('users')->group(function() {
    Route::get("/{uuid}")->whereUuid('uuid');
    Route::put("/{uuid}")->whereUuid('uuid');
    Route::delete("/{uuid}")->whereUuid('uuid');
});
