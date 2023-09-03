<?php

use App\Http\Controllers\AdminManagement;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthManager::class, 'home'])->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/tripList', [GeneralController::class, 'tripList'])->name('trip.list');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [AuthManager::class, 'profile'])->name('profile');
    Route::get('/destination', [AdminManagement::class, 'destination'])->name('destination');
    Route::post('/destination', [AdminManagement::class, 'destinationPost'])->name('destination.post');
    Route::get('/trip', [AdminManagement::class, 'trip'])->name('trip');
    Route::post('/trip', [AdminManagement::class, 'tripPost'])->name('trip.post');
    Route::get('/reserveTrip', [AdminManagement::class, 'reserveTrip'])->name('trip.reserve');
    Route::post('/reserveTrip', [AdminManagement::class, 'reserveTripPost'])->name('trip.reserve.post');
    Route::delete('/reserveTrip', [AdminManagement::class, 'reserveTripDelete'])->name('trip.reserve.delete');
    Route::get('/userTripList', [AdminManagement::class, 'userTripList'])->name('user.trip.list');
    Route::get('/userTripRating', [AdminManagement::class, 'userTripRating'])->name('user.trip.rating');
    Route::post('/userTripRating', [AdminManagement::class, 'userTripRatingPost'])->name('user.trip.rating.post');
    Route::get('/destinationDashboard', [AdminManagement::class, 'destinationDashboard'])->name('destination.dashboard');
});
