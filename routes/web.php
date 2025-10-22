<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SettingsController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\PostReadController;
use App\Http\Controllers\Post\SavedPostController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\RegisterUserController;

Route::get('/', [BlogController::class, 'index']);

Route::middleware('guest')->group(function () {
  Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
  Route::post('/register', [RegisterUserController::class, 'store']);
  Route::get('/login', [SessionController::class, 'create'])->name('login');
  Route::post('/login', [SessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
  Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
  
  Route::put('/{user:username}', [ProfileController::class, 'update'])->name('profile.update');
  Route::patch('/{user:username}/picture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
  
  Route::patch('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
  Route::patch('/settings/preferences', [SettingsController::class, 'updatePreferences'])->name('settings.updatePreferences');
  Route::delete('/settings/account', [SettingsController::class, 'deleteAccount'])->name('settings.deleteAccount');

  Route::post('/user/{user}/follow', [FollowController::class, 'store']);
  Route::delete('/user/{user}/follow', [FollowController::class, 'destroy']);

  Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
  Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
  Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

  Route::post('/posts/{post}/read', [PostReadController::class, 'store'])->name('posts.read.store');
  Route::delete('/posts/{post}/read', [PostReadController::class, 'destroy'])->name('posts.read.destroy');

  Route::post('/posts/{post}/save', [SavedPostController::class, 'store'])->name('posts.save.store');
  Route::delete('/posts/{post}/save', [SavedPostController::class, 'destroy'])->name('posts.save.destroy');

  Route::get('/notifications', [NotificationController::class, 'index']);
  Route::post('/notifications/read', [NotificationController::class, 'markAllAsRead']);
});

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
  Route::resource('posts', PostController::class)->except(['index', 'show']);
});

Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {
  Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
  Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/{user:username}', [ProfileController::class, 'show'])->name('profile.show');
