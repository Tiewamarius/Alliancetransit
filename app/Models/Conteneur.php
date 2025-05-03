<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Conteneur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function expeditions(): HasMany
    {
        return $this->hasMany(expeditions::class);
    }
}
