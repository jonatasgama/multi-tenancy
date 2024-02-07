<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CanalOrigem;

class CanalOrigemController extends Controller
{

    public function index(Request $req){
        $canais = CanalOrigem::all();
        return view('lista_canal_origem', [ 'canais' => $canais ]);
    }

    public function store(Request $req){
        $regras = [
            'canal' => 'required',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $req->validate($regras, $feedback);

        $resultado = CanalOrigem::create($req->all());

        $msg = $resultado == true ? 'Consulta agendada com sucesso.' : 'Ocorreu algum erro, consulta não agendada.';
        $alert = $resultado == true ? 'success' : 'danger';

        return redirect()->route('canalorigem.create')->with('msg', $msg)->with('alert', $alert);
    }

    public function create(){
        return view('cadastra_canal_origem');
    }
}
