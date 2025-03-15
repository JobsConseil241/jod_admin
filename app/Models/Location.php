<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_contrat',
        'date_heure_debut',
        'date_heure_fin',
        'vehicule_id',
        'type_location',
        'jours',
        'statut',
        'comission',
        'etat_livraison_id',
        'etat_restitution_id',
        'livraison',
        'paiement_id',
        'client_id'
    ];

    public static function generateUniqueCode()
    {
        do {
            $code = 'CTR-' . strtoupper(Str::random(24));
        } while (self::where('code_contrat', $code)->exists());

        return $code;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vehicule() {
        return $this->belongsTo(Vehicule::class,);
    }

    public function pannes()
    {
        return $this->belongsToMany(Panne::class, 'location_pannes', 'location_id', 'panne_id')
            ->withTimestamps()->withPivot('status', 'montant') ;
    }

    public function etatAvantLocation() {
        return $this->belongsTo(EtatVehicule::class, 'etat_livraison_id');
    }

    public function etatApresLocation() {
        return $this->belongsTo(EtatVehicule::class, 'etat_restitution_id');
    }

    public function clientAssocie() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function paiementAssocie() {
        return $this->belongsTo(Paiement::class, 'paiement_id');
    }

    public function recouvrements()
    {
        return $this->hasMany(Recouvrement::class);
    }
}
