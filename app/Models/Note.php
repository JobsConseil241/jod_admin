<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = ['id', 'location_id', 'title'];

    public function location() {
        return $this->belongsTo(Location::class);
    }
}
