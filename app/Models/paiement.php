<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'expedition_id',
        'montant',
        'date_paiement',
        'methode_paiement',
        'statut_paiement_id',
    ];

    public function expedition()
    {
        return $this->belongsTo(expeditions::class);
    }

    public function statutPaiement()
    {
        return $this->belongsTo(status_paiement::class);
    }

    protected static function booted()
    {
        static::created(function ($paiement) {
            $expedition = $paiement->expedition;
            $expedition->montant_paye += $paiement->montant;
            $expedition->save();
        });
    }
}