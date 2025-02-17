<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLogController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('superadmin/dashboard', function () {
    return view('superadmin.dashboard');
})->middleware(['auth', 'verified'])->name('superadmin.dashboard');

Route::get('user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('user.dashboard');

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('staff/dashboard', function () {
    return view('staff.dashboard');
})->middleware(['auth', 'verified'])->name('staff.dashboard');



 Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
 Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
 Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

 Route::middleware('role:superadmin')->group(function () {
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::get('roles/{role}/add-permissions', [RoleController::class, 'addPermissions'])->name('roles.add-permissions');
    Route::put('roles/{role}/give-permissions', [RoleController::class, 'givePermissions'])->name('roles.give-permissions');
});
    
Route::prefix('management')->group(function() {
   
    Route::get('index', [UserController::class, 'index'])->name('management.index');
    Route::post('store', [UserController::class, 'store'])->name('management.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('management.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('management.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('management.destroy');
});


Route::get('/book-management', [BookController::class, 'index'])->name('book-management');
Route::post('/book-management', [BookController::class, 'store'])->name('books.store');
Route::delete('/book-management/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/book-management/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/book-management/{book}', [BookController::class, 'update'])->name('books.update');
Route::get('/book-management/search', [BookController::class, 'search'])->name('books.search');



Route::prefix('management')->group(function() {
   
    Route::get('index', [UserController::class, 'index'])->name('management.index');
    Route::post('store', [UserController::class, 'store'])->name('management.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('management.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('management.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('management.destroy');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
});











Route::get('/superadmin/booklog', [BookLogController::class, 'index'])->name('superadmin.booklog');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/staff.php';
require __DIR__.'/user.php';




