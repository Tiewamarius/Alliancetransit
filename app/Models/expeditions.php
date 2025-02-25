<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expeditions extends Model
{
    use HasFactory;

    protected $fillable= [
        'expediteur_id',
        'nom_expediteur',
        'numero_expediteur',
        'email_expediteur',
        'adresse_expediteur',
        'destinataire_id',
        'nom_destinataire',
        'numero_destinataire',
        'email_destinataire',
        'adresse_destinataire',
        'numeroSuivi',
        'designation',
        'numeroConteneur',
        'typeService',
        'dateEnlev',
        'dateLivr',
        'montant_total',
        'montant_paye',
        'status',
    ];

    // Relations Eloquent

    public function montantRestant()
    {
        return $this->montant_total - $this->montant_paye;
    }
    public function client()
    {
        return $this->belongsTo(clients::class);
    }

    public function expediteur()
    {
        return $this->belongsTo(Expediteur::class);
    }

    public function destinataire()
    {
        return $this->belongsTo(Destinataire::class);
    }

        public function colis()
    {
        return $this->hasMany(colis::class); // Exemple: One-to-Many
    }
}