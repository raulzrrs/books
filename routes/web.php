<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('books.index');
});

Route::get('/dashboard', function () {
    return to_route('books.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
    Route::post('/books/{book}/reserve', [BookController::class, 'reserve'])->name('books.reserve');


    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

require __DIR__ . '/auth.php';
