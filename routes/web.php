<?php

use App\Http\Controllers\Auth\ShipmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('maintenance');
});

Route::get('layouts/login', function () {
    return view('login');
});

Route::get('layouts/register', function () {
    return view('register');
});

Route::get('layouts/SuiviPage', function () {
    return view('SuiviPage');
});

Route::get('/SuiviPage', function () {
    return view('layouts/Client');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Shippement controller
    Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');
    Route::post('/shipments', [ShipmentController::class, 'store'])->name('shipments.store');
    Route::post('/shipments/{shipment}/track', [ShipmentController::class, 'addTracking'])->name('shipments.track');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';
