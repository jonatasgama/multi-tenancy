<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CanalOrigem extends Model
{
    use HasFactory;

    protected $table = 'canais_de_origem';

    protected $fillable = ['canal'];

    public function comments(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }
}
