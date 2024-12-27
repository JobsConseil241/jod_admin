<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panne extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'pannes';

    protected $fillable = [
        'name',
        'description',
        'category_panne_id'
    ];

    public function vehicules(){
        return $this->belongsToMany(Vehicule::class, 'vehicule_pannes', 'vehicule_id', 'panne_id')
            ->withTimestamps()->withPivot('status', 'montant');
    }

    public function categorie_pannes(){
        return $this->belongsTo(CategoryPanne::class);
    }
}
