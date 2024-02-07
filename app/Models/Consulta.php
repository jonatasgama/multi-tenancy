<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consulta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['paciente_id', 'tratamento_id', 'pagamento_id', 'inicio_consulta', 'fim_consulta', 'pagamento'];
    
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function tratamento(): BelongsTo
    {
        return $this->belongsTo(Tratamento::class);
    }

}
