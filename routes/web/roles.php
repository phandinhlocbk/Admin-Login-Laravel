<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    
    Route::get('/admin/index',[App\Http\Controllers\RolesController::class, 'index'])->name('roles.index');
    Route::post('/admin/store',[App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
    Route::delete('/admin/{role}/destroy',[App\Http\Controllers\RolesController::class, 'destroy'])->name('roles.destroy');

    Route::get('/roles/{role}/edit', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}/update', [App\Http\Controllers\RolesController::class, 'update'])->name('roles.update');

    Route::put('/roles/{role}/attach', [App\Http\Controllers\RolesController::class, 'attach_permission'])->name('roles.permission.attach');
    Route::put('/roles/{role}/detach', [App\Http\Controllers\RolesController::class, 'detach_permission'])->name('roles.permission.detach');


 
});