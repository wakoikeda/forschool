<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController; // GroupControllerをインポート

// 認証ルート
// Route::get('/', function () {
//     return view('welcome');
// });

// Breezeが追加する認証ルート
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// タスク管理ルート
Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create'); 
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

// プロフィール管理ルート
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// グループ管理ルート
Route::middleware(['auth'])->group(function () {
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create'); 
    Route::get('/groups/{id}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/groups/{id}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::put('/groups/{id}', [GroupController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{id}', [GroupController::class, 'destroy'])->name('groups.destroy');
});

// 認証ルート
require __DIR__.'/auth.php';
