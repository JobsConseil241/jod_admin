<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

//    public function privileges() {
//        return $this->hasMany('App\Models\V1\Privilege');
//    }
}
