<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePrivilege extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_privileges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'privilege_id',
        'role_id',
    ];

    /**
     * Get the privilege associated with the role privilege.
     */
    public function privilege()
    {
        return $this->belongsTo(Privilege::class);
    }

    /**
     * Get the role associated with the role privilege.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
