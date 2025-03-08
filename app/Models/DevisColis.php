<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisColis extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'particulier',
        'paysDepart',
        'paysArrivee',
        'villeDepart',
        'villeArrivee',
        'designation'
    ];
}

