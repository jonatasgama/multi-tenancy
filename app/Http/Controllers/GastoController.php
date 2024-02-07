<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;

class GastoController extends Controller
{
    
    public function index(Request $req)
    {
        $gastos = Gasto::all();
        return view('lista_gastos', [ 'gastos' => $gastos ]);        
    }

    public function create()
    {
        return view('cadastra_gasto');
    }

    public function store(Request $req)
    {
        $regras = [
            'item' => 'required|min:2',
            'valor' => 'required|min:1'
        ];

        $feedback = [
            'item.min' => 'O campo :attribute precisa no mínimo 2 caracteres',
            'required' => 'O campo :attribute deve ser preenchido',
            'item.min' => 'O campo :attribute precisa ter no mínimo o valor 1',
        ];

        $valor = str_replace(".","", $req->get('valor'));
        $valor = str_replace(",",".", $valor);
        
        $req['valor'] = $valor;
        $req->validate($regras, $feedback);

        $resultado = Gasto::create($req->all());

        $msg = $resultado == true ? 'Item cadastrado com sucesso.' : 'Ocorreu algum erro, item não cadastrado.';
        $alert = $resultado == true ? 'success' : 'danger'; 
        return redirect()->route('gasto.create')->with('msg', $msg)->with('alert', $alert);
    }
}
