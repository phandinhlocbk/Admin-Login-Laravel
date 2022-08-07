<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    
    Route::get('/admin/permission',[App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::delete('/admin/permission/{permission}/destroy',[App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.destroy');
    Route::post('/admin/permission/store',[App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');
    Route::get('/admin/permission/{permission}/edit',[App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/admin/permission/{permission}/update',[App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');

   
});