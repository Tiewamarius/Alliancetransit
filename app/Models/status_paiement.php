<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class status_paiement extends Model
{
    use HasFactory;

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
