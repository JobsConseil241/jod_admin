<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    /**
     * @OA\Property(
     *     property="id",
     *     description="UserType's id",
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
     *     description="UserType's name",
     *     type="string",
     * )
     */

    public $name;



    /**
     * @OA\Property(
     *     property="description",
     *     description="UserType's description",
     *     type="string",
     *     example="Description of UserType"
     * )
     */
    public $description;
}
