<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Paiement extends Model
{
    use HasFactory;

    public function contrat()
    {
        return $this->hasOne(Contrat::class);
    }

    public static function generateUniqueCode()
    {
        do {
            $code = 'PAIE-' . strtoupper(Str::random(24));
        } while (self::where('reference', $code)->exists());

        return $code;
    }
}
