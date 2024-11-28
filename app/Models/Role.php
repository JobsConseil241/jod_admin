<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'active',
        'user_type_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @OA\Property(
     *     property="id",
     *     description="Role's id",
     *     type="integer",
     * )
     */

    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    /**
     * @OA\Property(
     *     property="name",
     *     description="Role's name",
     *     type="string",
     * )
     */

    public $name;

    /**
     * @OA\Property(
     *     property="description",
     *     description="Role's description",
     *     type="string",
     * )
     */

    public $description;


    /**
     * Get the user type associated with the role.
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function privileges()
    {
        return $this->belongsToMany(Privilege::class, 'role_privileges', 'role_id', 'privilege_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }
}
