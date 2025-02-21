<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class expeditions extends Model
{
    protected $guard = [ // Ou guarded = [] si vous préférez
        'type_expedition', 'branche', 'date_expedition', 'heure_collecte', 'client',
        'telephone_client', 'adresse_client', 'nom_destinataire', 'telephone_destinataire',
        'adresse_destinataire', 'pays_depart', 'pays_arrivee', 'region_depart', 'region_arrivee',
        'zone_depart', 'zone_arrivee', 'type_paiement', 'methode_paiement', 'type_emballage',
        'description', 'quantite', 'poids', 'longueur', 'largeur', 'hauteur', 'montant', 'poids_total'
    ];

    public function client() { return $this->belongsTo(clients::class); }
    
}
