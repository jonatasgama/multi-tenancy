<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrimeiraSessao extends Model
{
    use HasFactory;

    protected $table = 'primeiras_sessoes';

    protected $fillable = ['paciente_id','data_sessao', 'plano_de_saude', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'anamnese', 'hipoteses_diagnostica', 'anotacoes_relevantes', 'metas_terapeuticas'];

    public function paciente(): BelongsTo
    /**
     * Get the user that owns the PrimeiraSessao
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    {
        return $this->belongsTo(Paciente::class, 'id', 'paciente_id');
    }
}
