<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('layouts/SuiviPage', function () {
//     return view('SuiviPage');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Suivi route
    Route::get('layouts/SuiviPage', [ProfileController::class, 'SuiviPage'])->name('SuiviPage');

    // Envoi route
    Route::get('layouts/Envois', [ProfileController::class, 'Envois'])->name('Envois');
    
    // Devis
    Route::post('/DemandDevis', [ProfileController::class, 'DemandDevis'])->name('DemandDevis');
    // Route::get('/envoisParticulier', [ProfileController::class, 'commande'])->name('envoisParticulier');
        
});

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';
