<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicule_id',
        'photo_avant',
        'photo_arriere',
        'photo_gauche',
        'photo_droite',
        'photo_dashboard',
        'photo_interieur'
    ];

    public function vehicule() {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }
}
