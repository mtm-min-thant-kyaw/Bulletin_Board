<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});
Route::get('/login',function(){
    return view('login');
});
Route::get('/post/list',function(){
    return view('postList');
});
Route::get('/post/create',function(){
    return view('createPost');
});
Route::get('/post/confirm',function(){
    return view('confirmCreatePost');
});

Route::get('/post/edit',function(){
    return view('editPost');
});
Route::get('user/create',function(){
    return view('User.createUser');
});
Route::get('user/create/confirm',function(){
    return view('User.confirmCreateUser');
});
Route::get('/user/list',function(){
    return view('User.userList');
});
Route::get('/user/edit/profile',function(){
    return view('User.editProfile');
});
Route::get('user/profile',function(){
    return view('User.profile');
});
Route::get('password/change',function(){
    return view('Password.changePassword');
});
Route::get('/password/forgot/',function(){
    return view('Password.forgotPasswordUpdate');
});
Route::get('password/reset',function(){
    return view('Password.forgotPassword');
});
