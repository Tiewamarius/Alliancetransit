<?php

use App\Http\Controllers\Admin\Auth\LoginAdminController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\Auth\AdminCrudController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('adminLogin', [LoginAdminController::class, 'create'])->name('admin.adminLogin');
    Route::post('adminLogin', [LoginAdminController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

     
    // welcome - Route
    Route::get('/dashboard', [AdminCrudController::class, 'dashboard'])->name('admin.dashboard');  
    
    // PaginationRoute
    Route::get('/pagination/pagination-data', [AdminCrudController::class, 'pagination']);
    
    // search Route
    Route::get('/admin-search', [AdminCrudController::class, 'search'])->name('admin.search');
    
    // ExpeditionForm - Route
    Route::get('mission', [AdminCrudController::class, 'ExpeditionForm'])->name('ExpeditionForm');
   
    // ExpeditionStor - Route
    Route::post('mission', [AdminCrudController::class, 'storeExpedition'])->name('storeExpedition');

    // ExpeditionEdit - Route
    Route::get('/editExpedition/{id}', [AdminCrudController::class, 'editExpedition'])->name('editExpedition');
    Route::post('admin/mission/{id}', [AdminCrudController::class, 'updateExpedition'])->name('updatExpedition');
    
    Route::get('rechercher.suivi', [AdminCrudController::class, 'rechercherSuivi'])->name('rechercher.suivi');
    
    Route::post('/admin/expeditions/{id}/update-status', [AdminCrudController::class, 'updateStatus'])->name('update.status');
    Route::post('/admin/expeditions/{id}/status', [AdminCrudController::class, 'updateStatus'])->name('update.status');

    Route::get('/expeditions/delete/{id}', [AdminCrudController::class, 'deleteExpedition'])->name('expeditions.delete');


    Route::get('/admin/mission/{expedition}/edit', [AdminCrudController::class, 'editExpedition'])->name('editExpedition.edit');
    Route::put('/admin/mission/{expedition}', [AdminCrudController::class, 'updateExpedition'])->name('updateExpedition.update');
    Route::delete('/admin/mission/{id}', [AdminCrudController::class, 'destroyExpedition'])->name('destroyExpeditions.destroy');


    // welcome - TableClients
    Route::get('allRdv', [AdminCrudController::class, 'allRdv'])->name('allRdv');  
    
    //  END RDV Request
    
    
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
        
            Route::post('admin/logout', [LoginAdminController::class, 'destroy'])->name('destroy');


            
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

    Route::post('logout', [LoginAdminController::class, 'destroy'])->name('admin.logout');
});
