<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function contrat() {
        return $this->belongsTo(Contrat::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
