<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vehicule() {
        return $this->belongsTo(Vehicule::class,);
    }

    public function etatAvantLocation() {
        return $this->belongsTo(EtatVehicule::class, 'etat_vehicule_id');
    }

}
