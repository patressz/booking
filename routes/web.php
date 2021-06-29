<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientController;
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

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/booking', [BookingController::class, 'create'])->name('createBooking');
Route::get('/all-booking', [BookingController::class, 'index'])->name('allBooking');
Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('editBooking');
Route::get('/booking/{id}/delete', [BookingController::class, 'show'])->name('deleteBooking');


Route::put('/booking/{id}/edit', [BookingController::class, 'update'])->name('updateBooking');
Route::delete('/booking/{id}/delete', [BookingController::class, 'destroy'])->name('destroyBooking');
Route::post('/booking', [BookingController::class, 'store'])->name('storeBooking');
Route::post('/reservation', [ClientController::class, 'store'])->name('storeReservation');


// Route::post('/test', [BookingController::class, 'test'])->name('test');

