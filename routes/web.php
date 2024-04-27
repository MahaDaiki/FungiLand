<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionContentController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SavedController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\settingsController;
use App\Http\Controllers\StatistiquesController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;















Route::get('/', function () {
    return view('welcome');
});
    // search/filter
Route::middleware(['guest'])->group(function () {
  

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

   

    Route::get('/forgotpassword', [ForgotPasswordController::class, 'forgetPassword'])->name('forgot_password_show');
    Route::post('/forgotpassword', [ForgotPasswordController::class, 'forgetPasswordPost'])->name('forgotpassword');

    Route::get('/resetpassword/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset_password');
    Route::post('/resetpassword/{token}', [ForgotPasswordController::class, 'resetPasswordPost'])->name('post_reset');
});
    
    Route::post('/search', [SearchController::class, 'search']);
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('posts/{post}', [CommentController::class, 'show'])->name('postdetails');


Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile/{userId}', [PostController::class, 'postByUser'])->name('profile');

    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/posts/create', [PostController::class, 'add'])->name('posts.add');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/posts/{post}/like', [LikesController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [LikesController::class, 'unlike'])->name('posts.unlike');

    Route::post('/posts/{post}/save', [SavedController::class, 'save'])->name('posts.save');
    Route::delete('/posts/{post}/unsave', [SavedController::class, 'unsave'])->name('posts.unsave');
      
    // Route::delete('/posts/{post}/unsaveprofile', [SavedController::class, 'unsaveinprofile'])->name('posts.unsave');

    

    Route::get('/collections/{user}', [CollectionController::class, 'index'])->name('collections.index');
    Route::get('/collections/{id}/show/{userId}', [CollectionController::class, 'show'])->name('collections.show');
    Route::post('/collections', [CollectionController::class, 'store'])->name('collections.store');
    Route::put('/collections/{id}', [CollectionController::class, 'update'])->name('collections.update');
    Route::delete('/collections/{id}', [CollectionController::class, 'destroy'])->name('collections.destroy');


    Route::get('/collectioncontents/{id}', [CollectionContentController::class, 'show'])->name('collection_contents.show');
    Route::post('/collectioncontents', [CollectionContentController::class, 'store'])->name('collection_contents.store');
    Route::put('/collectioncontents/{id}', [CollectionContentController::class, 'update'])->name('collection_contents.update');
    Route::delete('/collectioncontents/{id}', [CollectionContentController::class, 'destroy'])->name('collection_contents.destroy');


    // Route::get('/settings',[UserController::class, 'settings'])->name('settings');
    // Route::post('/updateuser',[UserController::class, ,'updateProfile'])->name('userupdate');
    // Route::post('/passwordchange',[UserController::class, 'changePassword'])->name('changepassword');

 
    Route::post('posts/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::put('posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::delete('saved-posts/{id}', [SavedController::class, 'removeSavedPost'])->name('saved-posts.remove');
    
});
Route::middleware(['CheckUserMatch'])->group(function () {
    Route::get('settings/{user}', [settingsController::class, 'edit'])->name('settings');
    Route::put('/settings/{user}/update', [settingsController::class, 'update'])->name('usersupdate');
    Route::put('/settings/{user}/update-password', [settingsController::class, 'updatePassword'])->name('updatePassword');
    
    Route::get('/SavedPosts/{userid}',[SavedController::class, 'index'])->name('saved-posts.index');
   

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

    Route::get('/stats',[StatistiquesController::class, 'index'])->name('admin.stats');
    // Route::get('/monthly-statistics', [StatistiquesController::class, 'monthlyStatistics']);
    Route::get('/daily-statistics', [StatistiquesController::class, 'dailyStatistics']);

    Route::get('/manage',[AdminController::class, 'manage'])->name('manange');

    Route::delete('/users/{id}', [AdminController::class,'deleteUser' ])->name('users.destroy');
    Route::post('/users/{id}/restore',[AdminController::class,'restoreUser' ])->name('users.restore');
    
    Route::delete('/posts/{id}', [AdminController::class,'deletePost' ])->name('posts.destroy');
    Route::post('/posts/{id}/restore', [AdminController::class,'restorePost' ])->name('posts.restore');
    

});

