<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'app',
        'fr',
        'en',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    /**
     * @OA\Property(
     *     property="id",
     *     description="Language's id",
     *     type="integer",
     * )
     */

    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    /**
     * @OA\Property(
     *     property="key",
     *     description="Language's key",
     *     type="string",
     * )
     */
    public $key;

    /**
     * @OA\Property(
     *     property="app",
     *     description="Language's app",
     *     type="string",
     * )
     */
    public $app;

    /**
     * @OA\Property(
     *     property="fr",
     *     description="Language's fr",
     *     type="string",
     * )
     */
    public $fr;

    /**
     * @OA\Property(
     *     property="en",
     *     description="Language's en",
     *     type="string",
     * )
     */
    public $en;
}
