<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\conteneurs;
use App\Models\destinataire;
use App\Models\expeditions;
use App\Models\expediteur;
use App\Models\clients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminCrudController extends Controller
{

// WELCOME - DASHBOARD
public function dashboard(){
        $expeditions = expeditions::all();
       // Nombre total d'expéditions
        $All = expeditions::count();

        $colisArrives = expeditions::where('status', 'en stock')->count();
        $coliLivre= expeditions::where('status', 'terminer')->count();
        $Encour= expeditions::where('status', 'encour')->count();
        $stock= expeditions::where('status', 'depot')->count();
        
        $totalExpeditions = expeditions::count();
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_client = 'Cl-'. $nombre_aleatoire;
        // $totalClients = expeditions::distinct('code_client')->count('code_client');
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_suivi = 'Al-'. $nombre_aleatoire;

        $nomsClients = clients::pluck('nom_client', 'id');

        $clients = clients::all();

        return view('admin.dashboard',compact('stock','Encour','All','colisArrives','coliLivre','expeditions'));
   

}
// END FUNCTION DASHBOARD

//sEARCH FONCTION----------------------------------------------------
public function search(Request $request)
    {
        $All= expeditions::count();
        $expeditions= expeditions::all();
        $stock = expeditions::where('status', 'depot')->count();
        $colisArrives = expeditions::where('status', 'depot')->count();
        $Encour  = expeditions::where('status', 'encour')->count();
        $coliLivre = expeditions::where('status', 'terminer')->count();
        // Nombre total d'expéditions
        $totalExpeditions = expeditions::count();
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $totalExpedition = expeditions::distinct('numeroSuivi')->count('numeroSuivi');
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_suivi = 'Al-'. $nombre_aleatoire;
        $nomsClients = clients::pluck('nom_client', 'id');
        $clients = clients::all();

        $search = $request->search;
        $results = expeditions::where(function($query) use($search){
            $query->where('expediteur_id','like',"%$search%")
            ->orwhere('nom_expediteur','like',"%$search%");
        })->get();
        // Personnalisez la requête de recherche

        return view('admin.search', compact('results','search','All',
        'colisArrives','coliLivre','Encour','stock','expeditions'));
    }

// EDIT
// EXPEDITIONS CRUD
public function ExpeditionForm(){
    $totalExpeditions = expeditions::count();
    $nombre_aleatoire = (string)(random_int(10000, 99999));
        
    $nombre_aleatoire = (string)(random_int(10000, 99999));
    $code_unique = 'Al-'. $nombre_aleatoire;

    $code_suivi = 'SU-'. $nombre_aleatoire;
    
    $nomsClients = clients::pluck('nom_client', 'id');
    
    $expeditions = expeditions::all();
    return view('admin.mission.Ajouterexpeditions',compact(
        'nomsClients','expeditions','code_unique','code_suivi'));
}



    public function update(Request $request, expeditions $expedition)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);
        
        $expedition->fill($request->expeditions())->save();

        return redirect()->route('admin.dashboard')->with('success','Student Has Been updated successfully');
    }
//End edit

//btn update
    public function updateStatus(Request $request, expeditions $expedition)
{
    $request->validate([
        'status' => 'required|in:encour,depot,terminer,en transit,en stock', // Validate the status value
    ]);

    $expedition->status = $request->input('status');
    $expedition->save();

    return back(); // Redirect back to the same page
}
//END UPDATE




public function storeExpedition(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'expediteur_id' => 'nullable',
        'nom_expediteur' => 'required',
        'numero_expediteur' => 'required',
        'email_expediteur' => 'nullable|email',
        'adresse_expediteur' => 'nullable',
        'destinataire_id' => 'nullable|exists:destinataires,id',
        'nom_destinataire' => 'required',
        'numero_destinataire' => 'required',
        'email_destinataire' => 'nullable|email',
        'adresse_destinataire' => 'nullable',
        'numeroSuivi' => 'required',
        'designation' => 'required',
        'numeroConteneur' => 'nullable',
        'typeService' => 'nullable',
        'dateEnlev' => 'nullable|date',
        'dateLivr' => 'nullable|date',
        'montant_total' => 'required|numeric',
        'montant_paye' => 'required|numeric',
        'status' => 'required|in:encour,depot,terminer',
    ]);
    // dd($validatedData);
    $expedition = expeditions::create($validatedData);
    return redirect()->route('admin.dashboard')->with('success', 'Expédition supprimée avec succès.');

}

public function editExpedition(expeditions $expedition)
    {
        return view('mission.editExpedition', compact('expedition'));
    }

public function voirExpedition(expeditions $expedition)
    {
        return view('mission.editExpedition', compact('expedition'));
        
    }

public function destroyExpedition(expeditions $expedition)
    {
        $expedition->delete();

        return redirect()->route('expeditions')->with('success', 'Expédition supprimée avec succès.');
    }
// END EXPEDITION CRUD

// COMMANDE CRUD
public function CommanForm(){
    $totalExpeditions = expeditions::count();
    $nombre_aleatoire = (string)(random_int(10000, 99999));
        
    $nombre_aleatoire = (string)(random_int(10000, 99999));
    $code_unique = 'Al-'. $nombre_aleatoire;

    $code_suivi = 'SU-'. $nombre_aleatoire;
    
    $nomsClients = clients::pluck('nom_client', 'id');
    
    $expeditions = expeditions::all();
    return view('admin.mission.Ajouterexpeditions',compact(
        'nomsClients','expeditions','code_unique','code_suivi'));
}

public function storeCommand(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'expediteur_id' => 'nullable',
        'nom_expediteur' => 'required',
        'numero_expediteur' => 'required',
        'email_expediteur' => 'nullable|email',
        'adresse_expediteur' => 'nullable',
        'destinataire_id' => 'nullable|exists:destinataires,id',
        'nom_destinataire' => 'required',
        'numero_destinataire' => 'required',
        'email_destinataire' => 'nullable|email',
        'adresse_destinataire' => 'nullable',
        'numeroSuivi' => 'required',
        'designation' => 'required',
        'numeroConteneur' => 'nullable',
        'typeService' => 'nullable',
        'dateEnlev' => 'nullable|date',
        'dateLivr' => 'nullable|date',
        'montant_total' => 'required|numeric',
        'montant_paye' => 'required|numeric',
        'status' => 'required|in:encour,depot,terminer',
    ]);
    // dd($validatedData);
    $expedition = expeditions::create($validatedData);
    return redirect()->route('admin.dashboard')->with('success', 'Expédition supprimée avec succès.');

}

// END COMMANDE CRUD


//CLIENT CRUD----------------------------------------------------------
            public function storeClient(Request $request)
            {
                // Validation des données du formulaire
                $request->validate([
                'code_client' => 'required|unique:clients,code_client', // Validation de l'unicité
                'nom_client' => 'required|string|max:255',
                'prenom_client' => 'nullable|string|max:255',
                'numero_client' => 'required|string|max:20', // Ajuster la longueur max si nécessaire
                'email_client' => 'required|email|max:255',
                'adresse_client' => 'required|string|max:255',]);

                $client = new clients();
                $client->code_client = $request->input('code_client'); // Utilisation du code unique
                $client->nom_client = $request->input('nom_client');
                $client->prenom_client = $request->input('prenom_client');
                $client->numero_client = $request->input('numero_client');
                $client->email_client = $request->input('email_client');
                $client->adresse_client = $request->input('adresse_client');
                $client->save();


                // Redirection avec un message de succès
                return redirect()->route('admin.dashboard')->with('success', 'Client ajouté avec succès.'); // Ajuster la route de redirection
                }
        
                // Edit client
                public function editCliens($id)
                    {
                    // Récupérer le client par son ID
                    $client = clients::findOrFail($id);

                    // Passer le client à la vue de modification
                    return view('admin.clients.editClients', ['client' => $client]);
                }

                    // Updateclient
                    public function updateClient(Request $request, $id)
                    {
                    // Validation des données du formulaire
                    $request->validate([
                        'code_client' => 'required|string|max:255',
                        'nom_client' => 'required|string|max:255',
                        'prenom_client' => 'nullable|string|max:255',
                        'numero_client' => 'required|string|max:20',
                        'email_client' => 'required|email|max:255',
                        'adresse_client' => 'required|string|max:255',
                    ]);

                    // Récupérer le client par son ID
                    $client = clients::findOrFail($id);

                    // Mettre à jour les données du client
                    $client->nom_client = $request->input('nom_client');
                    $client->prenom_client = $request->input('prenom_client');
                    $client->numero_client = $request->input('numero_client');
                    $client->email_client = $request->input('email_client');
                    $client->adresse_client = $request->input('adresse_client');
                    $client->save();

                    // Rediriger avec un message de succès
                    return redirect()->route('admin.clients')->with('success', 'Client mis à jour avec succès.');
            
            }
//END CLIENT CRUD----------------------------------------------------


//CRUD DESTINATAIRE--------------------------------------------------
            public function storeDestinataire(Request $request)
            {
                // Validation des données du formulaire
                $request->validate([
                'code_unique' => 'required|unique:destinataire,code_unique', // Validation de l'unicité
                'nom_destinataire' => 'required|string|max:255',
                'prenom_destinataire' => 'nullable|string|max:255',
                'numero_destinataire' => 'required|string|max:20', // Ajuster la longueur max si nécessaire
                'email_destinataire' => 'required|email|max:255',
                'adresse_destinataire' => 'required|string|max:255',]);

                $destinataire = new destinataire();
                $destinataire->code_unique = $request->input('code_unique'); // Utilisation du code unique
                $destinataire->nom_destinataire = $request->input('nom_destinataire');
                $destinataire->prenom_destinataire = $request->input('prenom_destinataire');
                $destinataire->numero_destinataire = $request->input('numero_destinataire');
                $destinataire->email_destinataire = $request->input('email_destinataire');
                $destinataire->adresse_destinataire = $request->input('adresse_destinataire');
                $destinataire->save();


                // Redirection avec un message de succès
                return redirect()->route('admin.dashboard')->with('success', 'Client ajouté avec succès.'); // Ajuster la route de redirection
                }

                // Edit client
                public function editDestinataire($id)
                {
                    // Récupérer le client par son ID
                    $destinataire = destinataire::findOrFail($id);

                    // Passer le destinataire à la vue de modification
                    return view('admin.destinataires.editdestinataire', ['destinataire' => $destinataire]);
                }

                    // Updatedestinataire
                    public function updatedestinataire(Request $request, $id)
                    {
                    // Validation des données du formulaire
                    $request->validate([
                        'nom_destinataire' => 'required|string|max:255',
                        'prenom_destinataire' => 'nullable|string|max:255',
                        'numero_destinataire' => 'required|string|max:20',
                        'email_destinataire' => 'required|email|max:255',
                        'adresse_destinataire' => 'required|string|max:255',
                    ]);

                // Récupérer le destinataire par son ID
                $destinataire = destinataire::findOrFail($id);

                // Mettre à jour les données du destinataire
                $destinataire->nom_destinataire = $request->input('nom_destinataire');
                $destinataire->prenom_destinataire = $request->input('prenom_destinataire');
                $destinataire->numero_destinataire = $request->input('numero_destinataire');
                $destinataire->email_destinataire = $request->input('email_destinataire');
                $destinataire->adresse_destinataire = $request->input('adresse_destinataire');
                $destinataire->save();

                // Rediriger avec un message de succès
                return redirect()->route('admin.destinataire')->with('success', 'Destinatair mis à jour avec succès.');
                    
            }
//END CRUD DESTINATAIRE--------------------------------------------------
            
  
//CRUD CONTENEUR---------------------------------------------------------
            public function storeConteneur(Request $request)
            {
                // Validation des données
                $request->validate([
                    'container_number' => 'required|unique:conteneurs',
                    'type' => 'required',
                    'location' => 'required',
                ]);

                // Création et enregistrement du conteneur
                $conteneur = new conteneurs();
                $conteneur->container_number = $request->input('container_number');
                $conteneur->type = $request->input('type');
                $conteneur->location = $request->input('location');
                $conteneur->save();

                // Redirection avec un message de succès
                return redirect()->route('admin.dashboard')->with('success', 'Conteneur créé avec succès.');
                }
                public function editConteneur($id)
                {
                    // Récupérer le conteneur par son ID
                    $conteneur = conteneurs::findOrFail($id);

                    // Passer le conteneur à la vue de modification
                    return view('admin.conteneur.', ['conteneur' => $conteneur]);
                }

                // Updatedestinataire
                public function updateconteneur(Request $request, $id)
                {
                // Validation des données du formulaire
                $request->validate([
                    'conteneur_number' => 'required|string|max:255',
                    'type' => 'nullable|string|max:255',
                    'location' => 'required|string|max:255',
                ]);

                // Récupérer le destinataire par son ID
                $conteneur = conteneurs::findOrFail($id);

                // Mettre à jour les données du destinataire
                $conteneur->conteneur_number = $request->input('conteneur_number');
                $conteneur->type = $request->input('type');
                $conteneur->location = $request->input('location');
                $conteneur->save();

                // Rediriger avec un message de succès
                return redirect()->route('admin.destinataire')->with('success', 'Client mis à jour avec succès.');
                

            }
//END CRUD CONTENEUR--------------------------------------------------
            
                
//CRUD-EXPEDITEUR
        
            public function storeExpediteur(Request $request)
            {
                // Validation des données du formulaire
                $request->validate([
                'code_unique' => 'required|unique:clients,code_unique', // Validation de l'unicité
                'nom_expediteur' => 'required|string|max:255',
                'prenom_expediteur' => 'nullable|string|max:255',
                'numero_expediteur' => 'required|string|max:20', // Ajuster la longueur max si nécessaire
                'email_expediteur' => 'required|email|max:255',
                'adresse_expediteur' => 'required|string|max:255',]);

                $expediteur = new expediteur();
                $expediteur->code_unique = $request->input('code_unique'); // Utilisation du code unique
                $expediteur->nom = $request->input('nom_expediteur');
                $expediteur->prenom = $request->input('prenom_expediteur');
                $expediteur->numero = $request->input('numero_expediteur');
                $expediteur->email = $request->input('email_expediteur');
                $expediteur->adresse = $request->input('adresse_expediteur');
                $expediteur->save();


                // Redirection avec un message de succès
                return redirect()->route('admin.dashboard')->with('success', 'expediteur ajouté avec succès.'); // Ajuster la route de redirection
                }

                // Edit expediteur
                public function editExpediteur($id)
                {
                    // Récupérer le expediteur par son ID
                    $expediteur = expediteur::findOrFail($id);

                    // Passer le expediteur à la vue de modification
                    return view('admin.expediteurs.editExpediteur', ['expediteur' => $expediteur]);
                }

                    // Update expediteur
                    public function updateExpediteur(Request $request, $id)
                    {
                    // Validation des données du formulaire
                    $request->validate([
                        'nom_expediteur' => 'required|string|max:255',
                        'prenom_expediteur' => 'nullable|string|max:255',
                        'numero_expediteur' => 'required|string|max:20',
                        'email_expediteur' => 'required|email|max:255',
                        'adresse_expediteur' => 'required|string|max:255',
                    ]);

                    // Récupérer le expediteur par son ID
                    $expediteur = expediteur::findOrFail($id);

                    // Mettre à jour les données du expedieteur
                    $expediteur->nom_expediteur = $request->input('nom_expediteur');
                    $expediteur->prenom_expediteur = $request->input('prenom_expediteur');
                    $expediteur->numero_expediteur = $request->input('numero_expediteur');
                    $expediteur->email_expediteur = $request->input('email_expediteur');
                    $expediteur->adresse_expediteur = $request->input('adresse_expediteur');
                    $expediteur->save();

                    // Rediriger avec un message de succès
                    return redirect()->route('admin.expediteur')->with('success', '_expediteur mis à jour avec succès.');
                
            }
}
