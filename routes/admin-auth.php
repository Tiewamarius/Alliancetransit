<?php

use App\Http\Controllers\Admin\Auth\LoginController; 
use App\Http\Controllers\Admin\Auth\AdminCrudController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\ExpeditController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Str;
use App\Models\clients; 
use App\Models\Expeditions; 

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
        $nombreClients= clients::count();
        return view('admin.dashboard',compact('nombreClients'));
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
    Route::get('/admin/clients/{id}/edit', [AdminCrudController::class, 'edit'])->name('clients.edit');
    Route::put('/admin/Ajoutclients/{id}', [AdminCrudController::class, 'update'])->name('clients.update');
    Route::delete('/admin/Ajoutclients/{id}', [AdminCrudController::class, 'destroy'])->name('clients.destroy');




    // Ajouter-receveur route view
    Route::get('Ajoutreceveur', function () {
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;
        return view('admin.clients.Ajoutreceveur', ['code_unique' => $code_unique]);
    });
    Route::post('admin/Ajoutreceveur', [AdminCrudController::class, 'storeReceveur'])->name('storeReceveur');

     // Edit receveur
     Route::get('/admin/receveur/{id}/editReceveur', [AdminCrudController::class, 'editReceveur'])->name('clients.editReceveur');
     Route::put('/admin/Ajoutreceveur/{id}', [AdminCrudController::class, 'update'])->name('clients.updateReceveur');
     Route::delete('/admin/Ajoutreceveur/{id}', [AdminCrudController::class, 'destroy'])->name('clients.destroy');
 
     Route::post('admin/logout', [LoginController::class, 'destroyAdmin'])->name('destroyAdmin');


    
    // Ajouter-Receveur route view
    Route::get('Ajoutreceveur', function () {
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;
        return view('admin.clients.Ajoutreceveur', ['code_unique' => $code_unique]);
    });    
        
    Route::post('admin/Ajoutreceveur', [AdminCrudController::class, 'storeReceveur'])->name('storeReceveur');


     // Ajouter-Conteneur route view
     Route::get('AjoutConteneur', function () {
        return view('admin.clients.AjoutConteneur');
    });
   

    Route::post('/clients', [AdminCrudController::class, 'storeConteneur'])->name('storeConteneur');

    //EXPETION

    Route::get('mission', function () {
        return view('admin.mission.Ajouterexpeditions');
    });
    
    
    Route::post('mission', [AdminCrudController::class, 'storeExpedition'])->name('storeExpedition');

    
});
