<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPanne extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'active'];

    public function pannes(){
        return $this->hasMany(Panne::class);
    }
}
