<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expeditions; // Assurez-vous d'importer votre modèle Envoi


class ExpeditionsController extends Controller
{
     public function store(Request $request)
    {
        // Validation des données (très important)
        $request->validate([
            'typeExpedition' => 'required',
            'branche' => 'required', // Ajoutez les validations pour tous les champs
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
            'quantite' => 'required|integer|min:1',
            'poids' => 'required|numeric|min:0',
            'longueur' => 'required|numeric|min:0',
            'largeur' => 'required|numeric|min:0',
            'hauteur' => 'required|numeric|min:0',
            'montant' => 'required|numeric|min:0',
            'poids_total' => 'required|numeric|min:0',
        ]);


        $envoi = new Expeditions();

        $envoi->type_expedition = $request->input('typeExpedition');
        $envoi->branche = $request->input('branche');
        $envoi->date_expedition = $request->input('dateExpedition');
        $envoi->heure_collecte = $request->input('heureCollecte');
        $envoi->client = $request->input('client');
        $envoi->telephone_client = $request->input('telephoneClient');
        $envoi->adresse_client = $request->input('adresseClient');
        $envoi->nom_destinataire = $request->input('nomDestinataire');
        $envoi->telephone_destinataire = $request->input('telephoneDestinataire');
        $envoi->adresse_destinataire = $request->input('adresseDestinataire');
        $envoi->pays_depart = $request->input('paysDepart');
        $envoi->pays_arrivee = $request->input('paysArrivee');
        $envoi->region_depart = $request->input('regionDepart');
        $envoi->region_arrivee = $request->input('regionArrivee');
        $envoi->zone_depart = $request->input('zoneDepart');
        $envoi->zone_arrivee = $request->input('zoneArrivee');
        $envoi->type_paiement = $request->input('typePaiement');
        $envoi->methode_paiement = $request->input('methodePaiement');
        $envoi->type_emballage = $request->input('type_emballage');
        $envoi->description = $request->input('description');
        $envoi->quantite = $request->input('quantite');
        $envoi->poids = $request->input('poids');
        $envoi->longueur = $request->input('longueur');
        $envoi->largeur = $request->input('largeur');
        $envoi->hauteur = $request->input('hauteur');
        $envoi->montant = $request->input('montant');
        $envoi->poids_total = $request->input('poids_total');

        $envoi->save();

        // Redirection ou message de succès
        return redirect()->back()->with('success', 'Envoi créé avec succès.'); // Ou une autre route
    }
}
