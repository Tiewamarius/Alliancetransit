<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\conteneurs;
use App\Models\receveurs;
use App\Models\expeditions;
use App\Models\clients;
use App\Models\destinataire;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminCrudController extends Controller
{

    //EXPEDITION CRUD
    public function storeExpedition(Request $request)
    {
        // Validation des données (très important)
        $validatedData =$request->validate([
            'typeExpedition' => 'required',
            'conteneur' => 'required', // Ajoutez les validations pour tous les champs
            'dateExpedition' => 'required|date',
            'heureCollecte' => 'required|date_format:H:i',
            'client' => 'required',
            'telephoneClient' => 'required',
            'adresseClient' => 'required',
            'nomDestinataire' => 'required',
            'telephoneDestinataire' => 'required',
            'adresseDestinataire' => 'required',
            'paysDepart' => 'required',
            'paysArrivee' => 'required',
            'regionDepart' => 'required',
            'regionArrivee' => 'required',
            'zoneDepart' => 'required',
            'zoneArrivee' => 'required',
            'typePaiement' => 'required',
            'methodePaiement' => 'required',
            'type_emballage' => 'required',
            'description' => 'required',
            'quantite' => '|integer|min:1',
            'poids' => '|numeric|min:0',
            'longueur' => 'required|numeric|min:0',
            'largeur' => '|numeric|min:0',
            'hauteur' => '|numeric|min:0',
            'montant' => '|numeric|min:0',
            'poids_total' => '|numeric|min:0',
            'container_number' => 'required',
        ]);

    // Vérifier si le conteneur existe déjà
    $conteneur = conteneurs::where('container_number', $validatedData['container_number'])->first();

    if (!$conteneur) {
        // Créer un nouveau conteneur s'il n'existe pas
        conteneurs::create([
            'container_number' => $validatedData[
                'container_number'],
                'type' => 'Inconnu', // Valeur par défaut ou à déterminer
                'location' => 'Inconnu', // Valeur par défaut ou à déterminer
        ]);
    }


        $Expedition = expeditions::create($request->all());


        $Expedition->save();

        // Redirection ou message de succès
        return redirect()->back()->with('success', 'Envoi créé avec succès.'); // Ou une autre route
    }

    //END CRUD-EXPEDITION
   
    public function storeClient(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'code_unique' => 'required|unique:clients,code_unique', // Validation de l'unicité
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'numero' => 'required|string|max:20', // Ajuster la longueur max si nécessaire
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:255',]);

        // Création et enregistrement du client
        $client = new clients();
        $client->code_unique = $request->input('code_unique'); // Utilisation du code unique
        $client->nom = $request->input('nom');
        $client->prenom = $request->input('prenom');
        $client->numero = $request->input('numero');
        $client->email = $request->input('email');
        $client->adresse = $request->input('adresse');
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
        'nom' => 'required|string|max:255',
        'prenom' => 'nullable|string|max:255',
        'numero' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'adresse' => 'required|string|max:255',
    ]);

    // Récupérer le client par son ID
    $client = clients::findOrFail($id);

    // Mettre à jour les données du client
    $client->nom = $request->input('nom');
    $client->prenom = $request->input('prenom');
    $client->numero = $request->input('numero');
    $client->email = $request->input('email');
    $client->adresse = $request->input('adresse');
    $client->save();

    // Rediriger avec un message de succès
    return redirect()->route('admin.clients')->with('success', 'Client mis à jour avec succès.');
}


// Destinataire Crud
public function storeDestinataire(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'code_unique' => 'required|unique:clients,code_unique', // Validation de l'unicité
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'numero' => 'required|string|max:20', // Ajuster la longueur max si nécessaire
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:255',]);

        // Création et enregistrement du client
        $client = new destinataire();
        $client->code_unique = $request->input('code_unique'); // Utilisation du code unique
        $client->nom = $request->input('nom');
        $client->prenom = $request->input('prenom');
        $client->numero = $request->input('numero');
        $client->email = $request->input('email');
        $client->adresse = $request->input('adresse');
        $client->save();

        // Redirection avec un message de succès
        return redirect()->route('admin.dashboard')->with('success', 'Client ajouté avec succès.'); // Ajuster la route de redirection
    
    }
    // Edit receveur
    public function editDesti($id)
    {
        // Récupérer le client par son ID
        $client = receveurs::findOrFail($id);

        // Passer le client à la vue de modification
        return view('admin.receveur.editReceveur', ['receveur' => $client]);
    }


    // Update receveur
    public function update(Request $request, $id)
{
    // Validation des données du formulaire
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'nullable|string|max:255',
        'numero' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'adresse' => 'required|string|max:255',
    ]);

    // Récupérer le receveur par son ID
    $client = receveurs::findOrFail($id);

    // Mettre à jour les données du receveur
    $client->nom = $request->input('nom');
    $client->prenom = $request->input('prenom');
    $client->numero = $request->input('numero');
    $client->email = $request->input('email');
    $client->adresse = $request->input('adresse');
    $client->save();

    // Rediriger avec un message de succès
    return redirect()->route('admin.clients')->with('success', 'Client mis à jour avec succès.');
}


   


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
        return redirect()->route('admin.dashboard')->with('success', 'Conteneur créé avec succès.'); // Adaptez la route de redirection
    }
}