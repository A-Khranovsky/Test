<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', [TaskController::class, 'index'])->name('home');
Route::get('/tasks', [TaskController::class, 'userTasks'])->name('userTasks')->middleware('auth');
Route::get('/callback', [TaskController::class, 'callback']);
Route::get('/logout', [TaskController::class, 'logout'])->name('logout');
