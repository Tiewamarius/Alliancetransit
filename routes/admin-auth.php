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
    Route::get('register', [LoginAdminController::class, 'create'])->name('admin.register');
    Route::post('register', [LoginAdminController::class, 'storee']);

    Route::get('adminLogin', [LoginAdminController::class, 'create'])->name('admin.adminLogin');
    Route::post('adminLogin', [LoginAdminController::class, 'store']);

});

// Route::post('/contact', [AdminCrudController::class, 'sendContactForm'])->name('contact.send');

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
    
    Route::get('/expeditions/delete/{id}', [AdminCrudController::class, 'deleteExpedition'])->name('expeditions.delete');


    Route::get('/admin/mission/{expedition}/edit', [AdminCrudController::class, 'editExpedition'])->name('editExpedition.edit');
    Route::put('/admin/mission/{expedition}', [AdminCrudController::class, 'updateExpedition'])->name('updateExpedition.update');
    Route::delete('/admin/mission/{id}', [AdminCrudController::class, 'destroyExpedition'])->name('destroyExpeditions.destroy');


    // welcome - allRdv
    Route::get('allRdv', [AdminCrudController::class, 'allRdv'])->name('allRdv');  
    Route::delete('/admin/rendevous/{rendevouse}', [AdminCrudController::class, 'destroyRdv'])->name('deleteRdv.destroy');
    //  END RDV Request
    
    // welcome - allDevis
    Route::get('allDevis', [AdminCrudController::class, 'allDevis'])->name('allDevis');  
    Route::get('editDevis/{id}', [AdminCrudController::class, 'editDevis'])->name('editDevis');
    Route::put('updateDevis/{id}', [AdminCrudController::class, 'updateDevis'])->name('updateDevis');
    
    Route::get('deleteDevis/{id}', [AdminCrudController::class, 'deleteDevis'])->name('deleteDevis.delete');
    
    // END DevisRequest

    // welcome - allNotes
    Route::get('allNote', [AdminCrudController::class, 'allNote'])->name('allNote');  
    Route::get('editNote/{id}', [AdminCrudController::class, 'editNote'])->name('editNote');
    Route::put('updateNote/{id}', [AdminCrudController::class, 'updateNote'])->name('updateNote');
    
    Route::get('deleteNote/{id}', [AdminCrudController::class, 'deleteNote'])->name('deleteNote.delete');
    
    // END NoteRequest
    

    // Admin-Profile crud
    // Afficher le profil de l'administrateur connecté
    Route::get('Profile', [AdminCrudController::class, 'indexAdmin'])->name('admin.profile.index');

    // Afficher le formulaire d'édition du profil
    Route::get('Profile/edit', [AdminCrudController::class, 'editAdmin'])->name('admin.profile.edit');

    // Soumettre la mise à jour du profil
    Route::put('Profile', [AdminCrudController::class, 'updateAdmin'])->name('admin.profile.update');

    // Optionnel : Route pour changer le mot de passe (méthode PUT ou PATCH)
    Route::get('Profile/password/edit', [AdminCrudController::class, 'editPassword'])->name('admin.profile.password.edit');
    Route::put('Profile/password', [AdminCrudController::class, 'updatePassword'])->name('admin.profile.password.update');
    // Vous pourriez avoir une route pour changer le mot de passe ici aussi



    // ALL ADMINS
    // Liste des administrateurs
    Route::get('/Alladmins', [AdminCrudController::class, 'indexAdminList'])->name('admin.Alladmins.index');

    // Formulaire d'édition d'un administrateur
    Route::get('/admins/{admin}/edit', [AdminCrudController::class, 'editAdminUser'])->name('admin.admins.edit');

    // Route pour la mise à jour du rôle d'un administrateur
    Route::patch('/admins/{admin}/role', [AdminCrudController::class, 'updateAdminRole'])->name('admin.admins.updateRole');

    Route::post('admin/logout', [LoginAdminController::class, 'destroy'])->name('destroy');

    // Liste des Users
    Route::get('/AllUsers', [AdminCrudController::class, 'AbonneList'])->name('adminAbonneList.index');


    
//EXPETION


Route::post('logout', [LoginAdminController::class, 'destroy'])->name('admin.logout');
});
