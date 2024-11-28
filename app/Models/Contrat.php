<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    public function EtatVehicule()
    {
        return $this->belongsTo(EtatVehicule::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }

    public function location(){
        return $this->belongsToMany(Location::class, 'locations', 'contrat_id', 'client_id');
    }
}
