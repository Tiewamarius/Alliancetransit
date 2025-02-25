<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class destinataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_destinataire',
        'prenom_destinataire',
        'numero_destinataire',
        'email_destinataire',
        'adresse_destinataire',
        // Ajoutez tous les autres champs que vous voulez autoriser
    ];
}
