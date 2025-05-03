<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class rendevous extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'rdv_id',
        'type',
        'nom',
        'telephone',
        'code_postal',
        'date_retrait',
        'heure_retrait',
        'designation',
        'status',
    ];
}
