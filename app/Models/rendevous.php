<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class rendevous extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'numero_suivi',
        'date_retrait',
        'heure_retrait',
        'designation',
    ];
}
