<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
class expeditions extends Model
{
    use HasFactory;

    protected $fillable= [
        'particulier',
        'expediteur_id',
        'nom_expediteur',
        'numero_expediteur',
        'email_expediteur',
        'adresse_expediteur',
        'code_postal_exp',
        'destinataire_id',
        'nom_destinataire',
        'numero_destinataire',
        'email_destinataire',
        'adresse_destinataire',
        'code_postal_dest',
        'commune',
        'numeroSuivi',
        'designation',
        'conteneur_id',
        'typeService',
        'dateEnlev',
        'dateCharg',
        'dateLivr',
        'montant_total',
        'montant_paye',
        'montant_verse',
        'mode_paiement',
        'status',
        'image_colis',
    ];

    // cast datetime
    protected $casts = [
        'dateEnlev' => 'datetime',
        'dateCharg' => 'datetime',
        'dateLivr' => 'datetime',
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
        return $this->hasMany(DevisColis::class); // Exemple: One-to-Many
    }

    public function conteneur(): BelongsTo
    {
        return $this->belongsTo(Conteneur::class);
    }
}