<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;








Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [UserController::class, 'index'])->name('profile');

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [PostController::class, 'postbyuser'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/posts/create', [PostController::class, 'add'])->name('posts.add');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});


Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin',[AdminController::class, 'index'])->name('admin.index');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('categories.create');
Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class,'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class,'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class,'destroy'])->name('categories.destroy');

Route::get('/tags/create', [TagController::class,'create'])->name('tags.create');
Route::post('/tags', [TagController::class,'store'])->name('tags.store');
Route::get('/tags/{tag}/edit', [TagController::class,'edit'])->name('tags.edit');
Route::put('/tags/{tag}', [TagController::class,'update'])->name('tags.update');
Route::delete('/tags/{tag}', [TagController::class,'destroy'])->name('tags.destroy');

});

