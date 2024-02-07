<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroSessao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'registro_sessoes';

    protected $fillable = [
        'paciente_id',
        'consulta_id',
        'rotina',
        'sono',
        'alimentacao',
        'atividade_fisica',
        'intestino',
        'ansiedade',
        'tristeza',
        'alegria',
        'motivacao',
        'autoestima',
        'agenda',
        'ponte',
        'atividades_semana',
        'ajuda',
        'proxima_sessao',
        'feedback',
        'aprendizagem',
        'observacao',
        'problemas',
        'resolucoes'
    ];
}
