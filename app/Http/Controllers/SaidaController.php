<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Saida;
use App\Models\Financeiro;
use Illuminate\Support\Facades\DB;

class SaidaController extends Controller
{

    public function index(Request $req)
    {
        $saidas = Saida::with(['gasto'])->get();
        return view('lista_saidas', [ 'saidas' => $saida ]);
    }

    public function create()
    {
        $gastos = Gasto::all();
        return view('cadastra_saida', [ 'gastos' => $gastos ]);
    }

    public function store(Request $req)
    {
        $valor_unidade = Gasto::find($req->gasto_id);
        $regras = [
            'quantidade' => 'required|min:1',
            'data_saida' => 'required'
        ];

        $feedback = [
            'quantidade.min' => 'O campo :attribute precisa ter no mínimo 1.',
            'required' => 'O campo :attribute deve ser preenchido',
        ];

        $req['valor_unidade'] = $valor_unidade->valor;
        $req->validate($regras, $feedback);

        $resultado = Saida::create($req->all());
        //insere informações na tabela de controle financeiro
        $financeiro = Financeiro::create([
            'data_registro' => $req->data_saida,
            'gasto_id' => $req->gasto_id,
            'quantidade' => $req->quantidade,
            'valor_unidade' => $valor_unidade->valor
        ]);

        $msg = $resultado == true ? 'Item cadastrado com sucesso.' : 'Ocorreu algum erro, item não cadastrado.';
        $alert = $resultado == true ? 'success' : 'danger';
        return redirect()->route('saida.create')->with('msg', $msg)->with('alert', $alert);
    }

    public function itemPorMes(Request $req){
        $gastos = Gasto::all();
        return view('itens_por_mes', [ 'gastos' => $gastos ]);
    }

    public function pesquisarItemPorMes(Request $req){
        //$itens = Saida::with(['gasto'])->where('gasto_id', $req->gasto_id)->whereBetween('data_saida', [$req->data_inicio, $req->data_fim])->get();
        $gastos = Gasto::all();
        DB::select("SET lc_time_names = 'pt_BR';");
        $itens = DB::select("SELECT g.item , monthname(s.data_saida) as mes, SUM(s.quantidade) as quantidade, s.valor_unidade, (SUM(s.quantidade) * s.valor_unidade) as total FROM saidas s INNER JOIN gastos g on g.id = s.gasto_id WHERE s.data_saida BETWEEN :inicio AND :fim AND g.id = :item GROUP BY g.item, mes, s.valor_unidade", [ 'inicio' => $req->data_inicio, 'fim' => $req->data_fim, 'item' => $req->gasto_id ]);
        return view('itens_por_mes', [ 'gastos' => $gastos, 'itens' => $itens ]);
    }

    public function gastosPorMes(Request $req){
        return view('gastos_por_mes');
    }

    public function pesquisarGastosPorMes(Request $req){
        DB::select("SET lc_time_names = 'pt_BR';");
        $itens = DB::select("SELECT g.item , monthname(f.data_registro) as mes, SUM(f.quantidade) as quantidade, f.valor_unidade, (SUM(f.quantidade) * f.valor_unidade) as total FROM financeiros f INNER JOIN gastos g on g.id = f.gasto_id WHERE f.data_registro BETWEEN :inicio AND :fim GROUP BY g.item, mes order by mes", [ 'inicio' => $req->data_inicio, 'fim' => $req->data_fim ]);
        return view('gastos_por_mes', [ 'itens' => $itens ]);
    }

    public function gastosEReceita(Request $req){
        return view('gastos_e_receita');
    }

    public function pesquisarGastoseReceitas(Request $req){
        DB::select("SET lc_time_names = 'pt_BR';");
        $itens = DB::select("select mes, receita, sum(saida) as saida, (receita - sum(saida)) as total from (select monthname(data_registro) as mes, sum(valor_tratamento) as receita, (SUM(quantidade) * valor_unidade) as saida from financeiros where pagamento != 'pendente' and data_registro BETWEEN :inicio AND :fim group by mes, gasto_id) as tbl group by mes", [ 'inicio' => $req->data_inicio, 'fim' => $req->data_fim ]);
        return view('gastos_e_receita', [ 'itens' => $itens ]);
    }
}
