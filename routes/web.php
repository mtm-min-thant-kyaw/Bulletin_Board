<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');
Route::get('/login/user', [AuthController::class, 'loginUser']); //To compact login user
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/user/list', [UserController::class, 'userListPage'])->name('user.userlist');
Route::get('/user/create', [UserController::class, 'userCreatePage'])->name('user.userCreatePage');
Route::post('/user/create/',[UserController::class,'createUser'])->name('user.createUser');


Route::get('user/profile', [ProfileController::class, 'profilePage'])->name('user.profilePage');
Route::get('user/profile/edit', [ProfileController::class, 'profileEditPage'])->name('user.profileEdit');
Route::get('/post/list', [PostController::class, 'postListPage'])->name('post.postlist');
Route::get('/post/create',[PostController::class,'postCreatePage'])->name('post.createPage');
Route::post('/post/create',[PostController::class,'postCreate'])->name('post.create');
