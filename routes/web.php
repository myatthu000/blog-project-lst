<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;




//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[PageController::class,'index'])->name('page.index');
Route::get('/detail/{slug}',[PageController::class,'detail'])->name('page.detail');
Route::get('/category/{categories:slug}',[PageController::class,'postByCategory'])->name('page.category');
Route::get('/author/{name}',[PageController::class,'author'])->name('page.author');

//Route::get('/notifications',[NotificationController::class,'notify'])->name('notification.index');
Route::get('/read/{id}',[NotificationController::class,'read'])->name('notification.read');
Route::get('/unread/{id}',[NotificationController::class,'unread'])->name('notification.unread');


Auth::routes();

Route::prefix('/dashboard')->group(function (){
    Route::middleware(['auth','isBanded'])->group(function (){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('user', UserController::class);
        Route::resource('post', PostController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('comment', CommentController::class);
        Route::resource('reply', ReplyController::class);
        Route::get('search/post',[PostController::class,'searchQ'])->name('post.search');
        Route::get('search/category',[CategoryController::class,'search'])->name('category.search');
        Route::get('photo',[PhotoController::class,'index'])->name('photo.index');
        Route::get('trash',[PostController::class,'trashes'])->name('post.trash');
        Route::delete('post/forceDelete/{post}',[PostController::class,'forceDelete'])->name('post.force');
        Route::delete('post/restore/{post}',[PostController::class,'restore'])->name('post.restore');
        Route::delete('photo/{photo}',[PhotoController::class,'destroy'])->name('photo.destroy');

        Route::post('user',[UserController::class,'bandUser'])->name('user.band');
        Route::post('user/role/administrator',[UserController::class,'userRoleChangeAdmin'])->name('user.roleAdmin');
        Route::post('user/role/editor',[UserController::class,'userRoleChangeEditor'])->name('user.roleEditor');
        Route::post('user/role/author',[UserController::class,'userRoleChangeAuthor'])->name('user.roleAuthor');
        Route::get('settings',[UserManagementController::class,'toSettings'])->name('management.setting');
        Route::post('user/change_password',[UserManagementController::class,'passwordChange'])->name('user.change');
//        Route::post('user/role',[UserController::class,'userRoleChangeAuthor'])->name('user.roleAuthor');
//        Route::post('user/role',[UserController::class,'userRoleChangeAdmin'])->name('user.roleAdmin');

    });
});




