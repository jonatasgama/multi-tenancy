<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'avaliacoes';

    protected $fillable = [
        'paciente_id',
        'familia_avalicao_1_a_5',
        'familia_gostaria_de_alcancar',
        'familia_dificuldades',
        'familia_diferente',
        'saude_avaliacao_1_a_5',
        'saude_gostaria_de_alcancar',
        'saude_dificuldades',
        'saude_diferente',
        'profissional_avaliacao_1_a_5',
        'profissional_gostaria_de_alcancar',
        'profissional_dificuldades',
        'profissional_diferente',
        'lazer_avaliacao_1_a_5',
        'lazer_gostaria_de_alcancar',
        'lazer_dificuldades',
        'lazer_diferente',
        'financeiro_avaliacao_1_a_5',
        'financeiro_gostaria_de_alcancar',
        'financeiro_dificuldades',
        'financeiro_diferente',
        'afetiva_avaliacao_1_a_5',
        'afetiva_gostaria_de_alcancar',
        'afetiva_dificuldades',
        'afetiva_diferente',
        'academia_avaliacao_1_a_5',
        'academia_gostaria_de_alcancar',
        'academia_dificuldades',
        'academia_diferente',
        'espiritualidade_avaliacao_1_a_5',
        'espiritualidade_gostaria_de_alcancar',
        'espiritualidade_dificuldades',
        'espiritualidade_diferente',
        'social_avaliacao_1_a_5',
        'social_gostaria_de_alcancar',
        'social_dificuldades',
        'social_diferente',
        'justica_social_avaliacao_1_a_5',
        'justica_social_gostaria_de_alcancar',
        'justica_social_dificuldades',
        'justica_social_diferente',
        'autoconceito_avaliacao_1_a_5',
        'autoconceito_gostaria_de_alcancar',
        'autoconceito_dificuldades',
        'autoconceito_diferente'
    ];
}
