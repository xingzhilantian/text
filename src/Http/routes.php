<?php

use Illuminate\Support\Facades\Route;

//管理员登录
Route::post('login', 'AdminController@login');