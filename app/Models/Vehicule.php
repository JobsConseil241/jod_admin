<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'modele',
        'couleur',
        'annee',
        'immatriculation',
        'type_carburant',
        'prix_location',
        'kilometrage',
        'nombre_places',
        'nombre_portes',
        'transmission',
        'assurance_nom',
        'assurance_date_expi',
        'longitude',
        'latitude',
        'category_id',
        'marque_id',
        'note'
    ];

    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie');
    }

    public function marque()
    {
        return $this->belongsTo('App\Models\Marque');
    }

    public function vehiculeMedias()
    {
        return $this->hasMany('App\Models\VehiculeMedia');
    }

    public function pannes()
    {
        return $this->belongsToMany(Panne::class, 'vehicule_pannes', 'vehicule_id', 'panne_id');
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
}
