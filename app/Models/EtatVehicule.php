<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EtatVehicule extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'kilometrage',
        'proprete_int',
        'propreter_exte',
        'carburant',
        'cle_vehicule',
        'carte_grise',
        'carte_assurance',
        'carte_viste_technique',
        'carte_extincteur',
        'triangle_signalisation',
        'extincteur',
        'trousse_secours',
        'gilet',
        'cric_manivelle',
        'cle_a_roue',
        'cales_metalliques',
        'cle_plate',
        'anneau_remorquage',
        'tournevis',
        'compresseur',
        'roue_secours',
        'date',
        'etat_general',
        'vehicule_id',
    ];

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }
}
