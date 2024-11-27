<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RolePrivilege extends pivot
{
    use HasFactory;

    protected $fillable = ['role_id', 'privilege_id'];

    // Relation avec le modèle Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relation avec le modèle Privilege
    public function privilege()
    {
        return $this->belongsTo(Privilege::class);
    }

}
