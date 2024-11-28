<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'verified_at',
        'source_ip_address',
        'source_server_info',
        'user_type_id',
        'is_active',
        'mfa_is_active',
        'google2fa_secret',
        'last_login_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified_at' => 'datetime',
        'last_login_date' => 'datetime',
        'is_active' => 'boolean',
        'mfa_is_active' => 'boolean',
    ];

    /**
     * @OA\Property(
     *     property="first_name",
     *     description="User's first_name",
     *     type="string",
     * )
     */

    public $first_name;

    /**
     * @OA\Property(
     *     property="last_name",
     *     description="User's last_name",
     *     type="string",
     * )
     */

    public $last_name;

    /**
     * @OA\Property(
     *     property="username",
     *     description="User's username",
     *     type="string",
     * )
     */


    public $phone_code;

    /**
     * @OA\Property(
     *     property="phone",
     *     description="User's phone",
     *     type="string",
     * )
     */

    public $phone;


    /**
     * Get the user type associated with the user.
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')->where('deleted', NULL);
    }


    public function location(){
        return $this->belongsToMany(Location::class, 'locations', 'contrat_id', 'client_id');
    }

    public function hasPrivilige($privilige)
    {
        return $this->roles->pluck('privileges')->flatten()->pluck('name')->contains($privilige);
    }
}
