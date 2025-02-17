<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookLogController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['role:admin'])->group(function(){
    Route::get('/admin/book-management', [BookController::class, 'index'])->name('admin.book-management');
    Route::post('/admin/book-management', [BookController::class, 'store'])->name('admin.books.store');
    Route::delete('/admin/book-management/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/admin/book-management/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/admin/book-management/{id}', [BookController::class, 'update'])->name('admin.books.update');
    Route::get('/admin/book-management/search', [BookController::class, 'search'])->name('admin.books.search');
});

Route::get('/admin/booklog', [BookLogController::class, 'index'])->name('admin.booklog');

Route::prefix('admin/management')->middleware(['role:admin'])->group(function() {
    Route::get('index', [UserController::class, 'index'])->name('admin.management.index');
    Route::post('store', [UserController::class, 'store'])->name('admin.management.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.management.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.management.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.management.destroy');
});


Route::get('admin/reports', function () {
    return view('admin.reports');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports');
