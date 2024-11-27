<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'active', 'user_type_id'];

    public function userType(){
        return $this->belongsTo('App\Models\V1\UserType', 'user_type_id', 'id');
    }

    public function privileges(){
        return $this->belongsToMany(Privilege::class, 'role_privileges')->withTimestamps();
    }
}
