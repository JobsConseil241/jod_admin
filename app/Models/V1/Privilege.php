<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_type_id'];

    public function userType(){
        return $this->belongsTo('App\Models\V1\UserType', 'user_type_id', 'id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_privileges')->withTimestamps();
    }
}
