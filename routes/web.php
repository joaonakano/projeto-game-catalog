<?php

use Illuminate\Support\Facades\Route;

// Rotas do projeto

// GET
Route::get("/");
Route::get("/login");
Route::get("/register");
Route::get("/games");
Route::get("/games/register");
Route::get("/games/{id}");
Route::get("/user");
Route::get("/users/{id}");
Route::get("/dashboard");

// PUT
Route::put("/games/{uuid}");
Route::put("/users/{uuid}");

// DELETE
Route::delete("/games/{uuid}");
Route::delete("/users/{uuid}");

// CREATE
Route::post("/register");
Route::post("/games/register");