<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class conteneurs extends Model
{
    use HasFactory;

    protected $fillable = [
        'container_number',
        'type',
        'location',
    ];
}
