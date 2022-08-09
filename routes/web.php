<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function() {
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/admin/posts/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
    Route::put('/admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
    Route::delete('/admin/users/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

});

Route::middleware('role:Admin')->group(function() {
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::put('/admin/users/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('users.role.attach');
    Route::put('/admin/users/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('users.role.detach');
    Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/admin/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/admin/permissions', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/admin/permissions/{permission}/destroy', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/admin/permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/admin/permissions/{permission}/update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');

    Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::Delete('/roles/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::put('/roles/{role}/attach', [App\Http\Controllers\RoleController::class, 'attach_permission'])->name('user.roles.attach');
    Route::put('/roles/{role}/detach', [App\Http\Controllers\RoleController::class, 'detach_permission'])->name('user.roles.detach');



});

Route::middleware(['can:view,user'])->group(function() {
    Route::get('/admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
});