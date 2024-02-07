<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Saida extends Model
{
    use HasFactory;

    protected $fillable = ['gasto_id', 'quantidade', 'valor_unidade', 'data_saida'];

    public function gasto(): BelongsTo
    {
        return $this->belongsTo(Gasto::class);
    }    
}
