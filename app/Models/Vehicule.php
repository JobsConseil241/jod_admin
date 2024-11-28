<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        ''
    ];

    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie');
    }

    public function marque(){
        return $this->belongsTo('App\Models\Marque');
    }

    public function vehiculeMedias(){
        return $this->hasMany('App\Models\VehiculeMedia');
    }

    public function pannes(){
        return $this->belongsToMany(Panne::class, 'vehicule_pannes', 'vehicule_id', 'panne_id');
    }

    public function contrats() {
        return $this->hasMany(Contrat::class);
    }
}
