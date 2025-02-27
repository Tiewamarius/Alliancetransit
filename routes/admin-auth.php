<?php

use App\Http\Controllers\Admin\Auth\LoginController; 
use App\Http\Controllers\Admin\Auth\AdminCrudController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Str;
use App\Models\clients; 
// use App\Models\destinataire; 
// use App\Models\expediteur;
use App\Models\expeditions; 

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);


    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
 
    // welcome - Route
    Route::get('/dashboard', [AdminCrudController::class, 'dashboard'])->name('admin.dashboard');
    
    // ExpeditionForm - Route
    Route::get('mission', [AdminCrudController::class, 'ExpeditionForm'])->name('ExpeditionForm');
   
    // ExpeditionStor - Route
    Route::post('mission', [AdminCrudController::class, 'storeExpedition'])->name('storeExpedition');

    // ExpeditionEdit - Route
    Route::get('/editExpedition/{id}', [AdminCrudController::class, 'editExpedition'])->name('editExpedition');
    Route::post('admin/mission/{id}', [AdminCrudController::class, 'updateExpedition'])->name('updatExpedition');
    
    Route::get('rechercher.suivi', [AdminCrudController::class, 'rechercherSuivi'])->name('rechercher.suivi');
    
    // Route::post('/admin/expeditions/{id}/update-status', [AdminCrudController::class, 'updateStatus'])->name('update.status');
    Route::post('/admin/expeditions/{id}/status', [AdminCrudController::class, 'updateStatus'])->name('update.status');

    Route::get('/admin/mission/{expedition}/edit', [AdminCrudController::class, 'editExpedition'])->name('editExpedition.edit');
    Route::put('/admin/mission/{expedition}', [AdminCrudController::class, 'updateExpedition'])->name('updateExpedition.update');
    Route::delete('/admin/mission/{id}', [AdminCrudController::class, 'destroyExpedition'])->name('destroyExpeditions.destroy');


        // AllClents route view
            Route::get('Allclients', function () {
                $client = clients::all();
                return view('admin.clients.allClients',['clients' => $client]);
            });
        // Ajouter-client route view
                Route::get('Ajoutclients', function () {
                    $nombre_aleatoire = (string)(random_int(10000, 99999));
                    $code_client = 'Cl-'. $nombre_aleatoire;
                    return view('admin.clients.Ajoutclients', ['code_client' => $code_client]);
                });
                Route::post('admin/Ajoutclients', [AdminCrudController::class, 'storeClient'])->name('storeClient');


        // Edit client
                Route::get('/admin/clients/{id}/editClient', [AdminCrudController::class, 'editClient'])->name('clients.editClient');
                Route::put('/admin/Ajoutclients/{id}', [AdminCrudController::class, 'update'])->name('clients.update');
                Route::delete('/admin/Ajoutclients/{id}', [AdminCrudController::class, 'destroy'])->name('clients.destroy');


        // Ajouter-destinataire route view
            Route::get('Ajoutdestinataire', function () {
                $nombre_aleatoire = (string)(random_int(10000, 99999));
                $code_unique = 'Al-'. $nombre_aleatoire;
                return view('admin.clients.Ajoutdestinataire', ['code_unique' => $code_unique]);
            });
            Route::post('admin/Ajoutdestinataire', [AdminCrudController::class, 'storeDestinataire'])->name('storeDestinataire');

            // Edit Destinataire
            Route::get('/admin/destinataire/{id}/editDestinataire', [AdminCrudController::class, 'edit'])->name('clients.edit');
            Route::put('/admin/destinataires/{id}', [AdminCrudController::class, 'update'])->name('clients.update');
            Route::delete('/admin/destinataires/{id}', [AdminCrudController::class, 'destroy'])->name('clients.destroy');
        
            Route::post('admin/logout', [LoginController::class, 'destroy'])->name('destroy');


            
        // Ajouter-Destinatair route view
            Route::get('destinataires', function () {
                return view('admin.clients.destinataires');
                });    
                    
                Route::post('admin/destinataires', [AdminCrudController::class, 'storeDestinataire'])->name('storeDestinataire');


        // Ajouter-Conteneur route view
                Route::get('AjoutConteneur', function () {
                    return view('admin.clients.AjoutConteneur');
                });
        

                Route::post('/clients', [AdminCrudController::class, 'storeConteneur'])->name('storeConteneur');

        //EXPETION


            
            
        // Ajouter-destinataire route view
                    Route::get('Ajoutdestinataire', function () {
                        $nombre_aleatoire = (string)(random_int(10000, 99999));
                        $code_unique = 'Al-'. $nombre_aleatoire;
                        return view('admin.clients.Ajoutdestinataire', ['code_unique' => $code_unique]);
                    });
                    Route::post('admin/Ajoutdestinataire', [AdminCrudController::class, 'storeDestinataire'])->name('storeDestinataire');

        // Edit conteneur
                Route::get('/admin/destinataire/{id}/editDestinataire', [AdminCrudController::class, 'editExpedition'])->name('clients.edit');
                Route::put('/admin/destinataires/{id}', [AdminCrudController::class, 'update'])->name('clients.update');
        Route::delete('/admin/destinataires/{id}', [AdminCrudController::class, 'destroy'])->name('clients.destroy');

Route::post('logout', [LoginController::class, 'destroy'])->name('logout');


    
});
