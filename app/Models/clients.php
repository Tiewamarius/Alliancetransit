<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['code_unique','nom', 'prenom', 'numero', 'email', 'adresse'];

    public function colisExpedies()
    {
        return $this->hasMany(Colis::class, 'expediteur_id');
    }

    public function colisRecus()
    {
        return $this->hasMany(Colis::class, 'destinataire_id');
    }
    public function expeditions() { return $this->hasMany(expeditions::class); }
    

}
