<?php

use App\Http\Controllers\Admin\Auth\LoginController; 
use App\Http\Controllers\Admin\Auth\AdminCrudController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\ExpeditController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Str;
use App\Models\clients; 
use App\Models\destinataire; 
use App\Models\expediteur;
use App\Models\colis;
use App\Models\expeditions; 

Route::prefix('admin')->middleware('guest:admin')->group(function () {

        
    Route::get('admin/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);


    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        $expeditions = expeditions::with(['client', 'expediteur', 'destinataire', 'colis'])->paginate(10);
       
        $nombreExpedition= expeditions::count();

        $nombreClients= clients::count();

        $colisArrives = expeditions::where('statut', 'arrivé')->count();

        // Nombre total d'expéditions
        $totalExpeditions = expeditions::count();
        return view('admin.dashboard',compact(
            'nombreClients','expeditions',
            'totalExpeditions',
            'colisArrives','nombreExpedition'));
    })->name('admin.dashboard');

    Route::post('admin/dashboard', [LoginController::class, 'destroyAdmin'])->name('destroyAdmin');


    // AllClents route view
    Route::get('Allclients', function () {
        $client = clients::all();
        return view('admin.clients.allClients',['clients' => $client]);
    });
    // Ajouter-client route view
    Route::get('Ajoutclients', function () {
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;
        return view('admin.clients.Ajoutclients', ['code_unique' => $code_unique]);
    });
    Route::post('admin/Ajoutclients', [AdminCrudController::class, 'storeClient'])->name('storeClient');


    // Edit client
    Route::get('/admin/clients/{id}/edit', [AdminCrudController::class, 'editClient'])->name('clients.editClient');
    Route::put('/admin/Ajoutclients/{id}', [AdminCrudController::class, 'update'])->name('clients.update');
    Route::delete('/admin/Ajoutclients/{id}', [AdminCrudController::class, 'destroy'])->name('clients.destroy');




    // Ajouter-destinataire route view
    Route::get('Ajoutdestinataire', function () {
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;
        return view('admin.clients.Ajoutdestinataire', ['code_unique' => $code_unique]);
    });
    Route::post('admin/Ajoutdestinataire', [AdminCrudController::class, 'storeDestinataire'])->name('storeDestinataire');

     // Edit receveur
     Route::get('/admin/destinataire/{id}/editDestinataire', [AdminCrudController::class, 'edit'])->name('clients.edit');
     Route::put('/admin/destinataires/{id}', [AdminCrudController::class, 'update'])->name('clients.update');
     Route::delete('/admin/destinataires/{id}', [AdminCrudController::class, 'destroy'])->name('clients.destroy');
 
     Route::post('admin/logout', [LoginController::class, 'destroyAdmin'])->name('destroyAdmin');


    
    // Ajouter-Receveur route view
    Route::get('destinataires', function () {
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;
        return view('admin.clients.destinataires', ['code_unique' => $code_unique]);
    });    
        
    Route::post('admin/destinataires', [AdminCrudController::class, 'storeReceveur'])->name('storeReceveur');


     // Ajouter-Conteneur route view
     Route::get('AjoutConteneur', function () {
        return view('admin.clients.AjoutConteneur');
    });
   

    Route::post('/clients', [AdminCrudController::class, 'storeConteneur'])->name('storeConteneur');

    //EXPETION

    Route::get('mission', function () {     
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Cl-'. $nombre_aleatoire;
            
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_suivi = 'Al-'. $nombre_aleatoire;


        $nomsClients = clients::pluck('nom', 'id');

        $clients = clients::all();
        $expeditions= expeditions::count();
        $expediteurs = expediteur::all();
        $destinataires = destinataire::all();
        $colis = colis::all();
        return view('admin.mission.Ajouterexpeditions',compact('code_unique','nomsClients','clients','expediteurs', 'destinataires', 'colis','code_suivi', 'expeditions'));
    });
    
    
    Route::post('mission', [AdminCrudController::class, 'storeExpedition'])->name('storeExpedition');

    
});
