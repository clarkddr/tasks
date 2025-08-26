<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::resource('/tasks',TaskController::class);
Route::get('/',[TaskController::class,'index'])->name('dashboard');


