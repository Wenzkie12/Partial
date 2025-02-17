<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PenaltyController;


Route::prefix('staff')->middleware(['role:staff'])->group(function () {
    Route::get('/book-management', [BookController::class, 'index'])->name('staff.book-management');
    Route::post('/book-management', [BookController::class, 'store'])->name('staff.books.store');
    Route::delete('/book-management/{book}', [BookController::class, 'destroy'])->name('staff.books.destroy');
    Route::get('/book-management/{id}/edit', [BookController::class, 'edit'])->name('staff.books.edit');
    Route::put('/book-management/{id}', [BookController::class, 'update'])->name('staff.books.update');
    Route::get('/book-management/search', [BookController::class, 'search'])->name('staff.books.search');
});

Route::get('/staff/reservation-list', [StaffController::class, 'reservationList'])->name('staff.reservation-list');
Route::post('/reservations/{id}/claim', [ReservationController::class, 'claim'])->name('reservations.claim');
Route::get('/staff/to-return-list', [StaffController::class, 'toReturnList'])->name('staff.to-return-list');
Route::post('/to-return-list/{id}/return', [ReservationController::class, 'returnBook'])->name('books.return');
Route::get('/staff/penalty-list', [PenaltyController::class, 'index'])->name('staff.penalty-list');
Route::get('/staff/payment-section', [StaffController::class, 'usersWithPenalties'])->name('staff.payment-section');
Route::get('/staff/payment-section', [PaymentController::class, 'index'])->name('staff.payment-section');
    Route::post('/staff/payment/{userId}', [PaymentController::class, 'store'])->name('staff.payment.store');