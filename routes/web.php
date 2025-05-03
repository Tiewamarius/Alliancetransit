<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::post('/contact', [ProfileController::class, 'creatNote'])->name('contact.creatNote');

// Route::get('/SuiviPage', function () {
//     return view('Clients.SuiviPage');
// });
// Suivi route without auth
Route::get(' /', [ProfileController::class, 'welcome'])->name('welcome');

Route::get(' /SuiviPage', [ProfileController::class, 'SuiviPage'])->name('SuiviPage');

Route::get('/search', [ProfileController::class, 'search'])->name('search');


Route::post('/contact', [ProfileController::class, 'sendContactForm'])->name('contact.send');

Route::get('/dashboard', [ProfileController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Compte
    
    Route::get('/compte', [ProfileController::class, 'compte'])->name('compte');
    
    // Suivi route
    // Route::get(' /SuiviPage', [ProfileController::class, 'SuiviPage'])->name('SuiviPage');

    // Route::get('/search', [ProfileController::class, 'search'])->name('search');
    // Envoi route
    Route::get('/Envois', [ProfileController::class, 'Envois'])->name('Envois');
    
    // Devis
    Route::post('/DemandDevis', [ProfileController::class, 'DemandDevis'])->name('DemandDevis');
    // Route::get('/envoisParticulier', [ProfileController::class, 'commande'])->name('envoisParticulier');
    
     // ExpeditionStor - Route
     Route::post('/EnvoisColis', [ProfileController::class, 'EnvoisColis'])->name('EnvoisColis');

    //  Store RDV
    Route::post('/storeRdv', [ProfileController::class, 'storeRdv'])->name('storeRdv');

    Route::delete('deleteRdv/{id}', [ProfileController::class, 'deleteRdv'])->name('deleteRdv.delete');
    

        
     //route ExpByFact
     Route::get('editExpByFac/{id}', [ProfileController::class, 'editExpByFac'])->name('editExpByFac');
     Route::put('updateExpByFac/{id}', [ProfileController::class, 'updateExpByFac'])->name('updateExpByFac');
  
     Route::delete('deleteFacture/{id}', [ProfileController::class, 'deleteFacture'])->name('deleteFacture.delete');
     Route::get('/viewExpByFact/{id}', [ProfileController::class, 'viewExpensesByFacture'])->name('viewExpensesByFacture');
    
    // END route ExpByFact

    Route::post('/rdv/{rdv}/statut/encour', [ProfileController::class, 'changerStatutEnEncour'])->name('rdv.statut.encour'); 
});

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';
