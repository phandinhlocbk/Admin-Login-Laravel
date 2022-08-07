<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::put('/admin/users/{user}/update',[App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
    Route::delete('/admin/users/{user}/destroy',[App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware('role:admin')->group(function() {
    Route::get('/admin/users/',[App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::put('/users/{user}/attach',[App\Http\Controllers\UserController::class, 'attach'])->name('users.role.attach');
    Route::put('/users/{user}/detach',[App\Http\Controllers\UserController::class, 'detach'])->name('users.role.detach');

});
Route::middleware('auth')->group(function() {
    Route::get('/admin/users/{user}/profile',[App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
});