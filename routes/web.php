<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


// Dashboard routes
Route::group(['prefix' => 'dashboard','middleware' => 'auth'], function() {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->middleware(['role:Admin'])->name('dashboard');

    // Item routes
    Route::get('/items', [\App\Http\Controllers\Backend\ItemController::class, 'index'])->name('item.index');
    Route::post('/item/generateId', [\App\Http\Controllers\Backend\ItemController::class, 'generateId'])->name('item.generateId');
    Route::get('/item/{item_id}/editor', [\App\Http\Controllers\Backend\ItemController::class, 'editor'])->name('item.editor');
    Route::post('/item/saveCode', [\App\Http\Controllers\Backend\ItemController::class, 'saveCode'])->name('item.saveCode');
    Route::get('/item/{item_id}/edit', [\App\Http\Controllers\Backend\ItemController::class, 'edit'])->name('item.edit');
    Route::put('item/{item_id}', [\App\Http\Controllers\Backend\ItemController::class, 'update'])->name('item.update');
    Route::delete('item/{item_id}', [\App\Http\Controllers\Backend\ItemController::class, 'destroy'])->name('item.destroy');

    // User routes
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->middleware(['role:Admin'])->name('user.index');
    Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->middleware(['role:Admin'])->name('user.store');
    Route::get('user/{user_id}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->middleware(['role:Admin'])->name('user.edit');
    Route::put('user/{user_id}', [\App\Http\Controllers\UserController::class, 'update'])->middleware(['role:Admin'])->name('user.update');
    Route::delete('user/{user_id}', [\App\Http\Controllers\UserController::class, 'destroy'])->middleware(['role:Admin'])->name('user.destroy');

    // Roles resource routes
    Route::resource('roles', \App\Http\Controllers\RoleController::class)->middleware(['role:Admin']);

});


Route::get('send-mail', [\App\Http\Controllers\MailController::class, 'index'])->name('email.send');
