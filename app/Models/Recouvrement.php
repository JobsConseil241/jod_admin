<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recouvrement extends Model
{
    protected $fillable = [
        'location_id', 'paiement_id', 'montant_du', 'montant_recouvre',
        'date_echeance', 'date_recouvrement', 'statut', 'commentaire', 'user_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
