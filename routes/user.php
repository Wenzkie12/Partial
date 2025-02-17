<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReservationController;
// use App\Http\Controllers\PersonalInfoController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\ReservationController;


Route::get('/book-management', [BookController::class, 'index'])->name('book-management');
Route::post('/book-management', [BookController::class, 'store'])->name('books.store');
Route::delete('/book-management/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/book-management/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/book-management/{id}', [BookController::class, 'update'])->name('books.update');
Route::get('/book-management/search', [BookController::class, 'search'])->name('books.search');
// Route::get('/personal-info', [PersonalInfoController::class, 'showProfile'])->name('personal-info');
//     Route::get('/edit/{field}', [PersonalInfoController::class, 'editField'])->name('edit');
//     Route::put('/personal-info', [PersonalInfoController::class, 'updatePersonalInfo'])->name('update');
// Route::get('/staff/penalty-list', [UserController::class, 'getUsersWithPenalties'])->name('staff.penalty-list');


Route::get('record-tracking', function () {
    return view('record-tracking');
})->middleware(['auth', 'verified', 'role:user'])->name('record-tracking');

// Route::get('/record-tracking', [ReservationController::class, 'userRecordTracking'])->name('record-tracking');

Route::post('/books/{book}/reserve', [ReservationController::class, 'store'])->name('books.reserve');
Route::get('/user/tracking', [ReservationController::class, 'userTracking'])->name('user.tracking');
