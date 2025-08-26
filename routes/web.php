<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RegisterUserController;

Route::get('/', [BlogController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/user/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('guest')->group(function () {
  Route::get('/register', [RegisterUserController::class, 'create']);
  Route::post('/register', [RegisterUserController::class, 'store']);
  Route::get('/login', [SessionController::class, 'create'])->name('login');
  Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy']);

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'myProfile'])->name('profile.myProfile');
  Route::put('/profile', [ProfileController::class, 'update']);
  Route::patch('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');

  Route::post('/user/{user}/follow', [FollowController::class, 'store']);
  Route::delete('/user/{user}/follow', [FollowController::class, 'destroy']);

  Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
  Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
  Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware(['admin', 'auth'])->prefix('/admin')->group(function () {
  Route::get('/dashboard', [AdminController::class, 'dashboard']);
  Route::resource('posts', PostController::class)->except(['index', 'show']);
});