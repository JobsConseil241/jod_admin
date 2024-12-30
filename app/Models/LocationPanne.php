<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationPanne extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'location_pannes';

    protected $fillable = ['status', 'montant'];

    public function vehicule() {
        return $this->belongsTo(Vehicule::class);
    }

    public function panne() {
        return $this->belongsTo(Panne::class);
    }
}
