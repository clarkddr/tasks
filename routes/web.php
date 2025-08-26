<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::resource('/tasks',TaskController::class);
Route::get('/',[TaskController::class,'index'])->name('dashboard');
// Route to use Draggable component
Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');

