<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    
    Route::get('/admin/posts/create',[App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts/',[App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::get('/admin/posts/',[App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::delete('/admin/posts/{post}/destroy',[App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/admin/posts/{post}/edit',[App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/admin/posts/{post}/update',[App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
});