<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expediteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_expediteur',
        'numero_expediteur',
        'email_expediteur',
        'adresse_expediteur'];

        
}
