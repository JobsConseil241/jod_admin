<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicule extends Model
{
    use HasFactory, softDeletes;

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
        'note',
        'thumb_url'
    ];

    public function categorie()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function vehiculeMedias()
    {
        return $this->hasMany(VehiculeMedia::class);
    }

    public function pannes()
    {
        return $this->belongsToMany(Panne::class, 'vehicule_pannes', 'vehicule_id', 'panne_id')
            ->withTimestamps()->withPivot('status', 'montant') ;
    }

    public function locations(){
        return $this->HasMany(Location::class, 'vehicule_id', 'id');
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function etats() {
        return $this->hasMany(EtatVehicule::class);
    }
}
