<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(); 
Route::get('/', 'HomeController@index')->name('home');  
Route::get('/post/{post}', 'PostController@show')->name('post.show');
Route::middleware('auth')->group(function(){ 
    Route::get('/admin', 'AdminsController@index')->name('admin.index'); 

    Route::get('/admin/posts/create', 'PostController@create')->name('post.create'); 
    Route::post('/admin/posts/store', 'PostController@store')->name('post.store'); 
    Route::get('/admin/posts', 'PostController@index')->name('post.index'); 
    Route::delete('/admin/posts/delete/{post}', 'PostController@destroy')->name('post.delete');
    Route::get('/admin/posts/edit/{post}', 'PostController@edit')->name('post.edit'); 
    Route::patch('/admin/posts/update/{post}', 'PostController@update')->name('post.update');
    
    Route::put('/admin/user/update/{user}', 'UserController@update')->name('user.update');
    Route::delete('/admin/user/delete/{user}', 'UserController@destroy')->name('user.delete');


});

Route::middleware(['role:Admin', 'auth'])->group(function(){
    Route::get('/admin/user', 'UserController@index')->name('user.index');
    Route::PUT('/user/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::PUT('/user/{user}/detach', 'UserController@detach')->name('user.role.detach');

    Route::get('/admin/roles', 'RoleController@index')->name('admin.role.index'); 
    Route::post('/admin/roles/store', 'RoleController@store')->name('admin.role.store'); 
    Route::delete('/admin/roles/{role}', 'RoleController@destroy')->name('admin.role.delete');
    Route::get('/admin/roles/edit/{role}', 'RoleController@edit')->name('admin.role.edit'); 
    Route::put('/admin/roles/update/{role}', 'RoleController@update')->name('admin.role.update');

    Route::PUT('/admin/{role}/attach', 'RoleController@attach_permission')->name('role.permission.attach');
    Route::PUT('/admin/{role}/detach', 'RoleController@detach_permission')->name('role.permission.detach');

    Route::get('/admin/permissions', 'PermissionController@index')->name('admin.permission.index');
    Route::post('/admin/permissions/store', 'PermissionController@store')->name('admin.permission.store'); 
    Route::delete('/admin/permissions/{permission}', 'PermissionController@destroy')->name('admin.permission.delete');
    Route::get('/admin/permission/edit/{permission}', 'PermissionController@edit')->name('admin.permission.edit'); 
    Route::put('/admin/permissions/update/{permission}', 'PermissionController@update')->name('admin.permission.update'); 

});
Route::middleware(['can:view,user'])->group(function(){
    Route::get('/admin/user/profile/{user}', 'UserController@show')->name('user.profile');
});

