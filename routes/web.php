<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');
Route::get('/login/user', [AuthController::class, 'loginUser']); //To compact login user
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/list', [UserController::class, 'userListPage'])->name('user.userlist');
    Route::get('/user/create', [UserController::class, 'userCreatePage'])->name('user.userCreatePage');
    Route::post('/user/confirm', [UserController::class, 'userConfirmPage'])->name('user.confirmPage');
    Route::post('user/store', [UserController::class, 'store'])->name('user.add'); //Common function for create user and update user
    Route::get('user/delete/{id}', [UserController::class, 'userDelete'])->name('user.delete');
    Route::get('user/edit/{id}',[UserController::class,'userEdit'])->name('user.edit');
    //Password
    Route::get('/password/change',[PasswordController::class,'passwordChangePage'])->name('user.passwordChange');
    Route::post('/password/update',[PasswordController::class,'passwordChange'])->name('password.change');

    //profile
    Route::get('user/profile', [ProfileController::class, 'profilePage'])->name('user.profilePage');
    Route::get('user/profile/edit/{id}', [ProfileController::class, 'profileEditPage'])->name('user.profileEdit');
    Route::patch('user/profile/update/{id}', [ProfileController::class, 'updateUser'])->name('user.update');

    /**This route view to post list and work search function */
    Route::get('/post/list', [PostController::class, 'postListPage'])->name('post.postlist');
    Route::get('/post/create', [PostController::class, 'postCreatePage'])->name('post.createPage');
    Route::post('/post/preview-create', [PostController::class, 'create'])->name('create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('post/delete/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/post/edit/{id}', [PostController::class, 'postEditPage'])->name('post.edit');
    Route::post('post/{post}/preview-edit', [PostController::class, 'previewEdit'])->name('post.preview');
    Route::post('post/{post}/update', [PostController::class, 'update'])->name('post.update');

    //Csv upload and download search result as excel file
    Route::get('post/csv/upload',[PostController::class,'uploadPage'])->name('post.csvUpload');
    Route::post('/post/upload', [PostController::class, 'uploadCsv'])->name('post.upload');
    Route::get('/post/download', [PostController::class, 'downloadExcel'])->name('post.download');
});
