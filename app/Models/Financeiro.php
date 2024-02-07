<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    use HasFactory;

    protected $fillable = ['data_registro', 'tratamento_id', 'pagamento_id', 'consulta_id', 'pagamento', 'valor_tratamento', 'gasto_id', 'quantidade', 'valor_unidade'];
}
