<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisColis extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'code_unique',
        'particulier',
        'paysDepart',
        'paysArrivee',
        'villeDepart',
        'villeArrivee',
        'designation',
        'montant_total',
        'status',
    ];
}

