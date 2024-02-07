<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tratamento;

class TratamentoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $tratamentos = Tratamento::all();
        return view('lista_tratamento', [ 'tratamentos' => $tratamentos ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cadastra_tratamento', ['funcao' => 'Cadastrar']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $regras = [
            'tratamento' => 'required|min:3',
            'valor' => 'required|min:3'
        ];

        $feedback = [
            'tratamento.min' => 'O campo tratamento precisa de no mínimo 3 caracteres',
            'valor.min' => 'O campo valor precisa de no mínimo 3 caracteres',
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $req->validate($regras, $feedback);

        $valor = str_replace(".","", $req->get('valor'));
        $valor = str_replace(",",".", $valor);

        $req['valor'] = $valor;
        $resultado = Tratamento::create($req->all());

        $msg = $resultado == true ? 'Registro cadastrado com sucesso.' : 'Ocorreu algum erro, registro não cadastrado.';
        $alert = $resultado == true ? 'success' : 'danger';
        //return view('cadastra_tratamento', [ 'msg' => $msg, 'alert' => $alert ]);
        return redirect()->route('tratamento.create')->with('msg', $msg)->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tratamento = Tratamento::find($id);
        return view('cadastra_tratamento', [ 'funcao' => 'Editar', 'tratamento' => $tratamento ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $regras = [
            'tratamento' => 'required|min:3',
            'valor' => 'required|min:3'
        ];

        $feedback = [
                'tratamento.min' => 'O campo tratamento precisa de no mínimo 3 caracteres',
                'valor.min' => 'O campo valor precisa de no mínimo 3 caracteres',
                'required' => 'O campo :attribute deve ser preenchido'
        ];

        $req->validate($regras, $feedback);

        $valor = str_replace(".","", $req->get('valor'));
        $valor = str_replace(",",".", $valor);

        $req['valor'] = $valor;
        $resultado = Tratamento::find($id);
        $resultado->update($req->all());

        $msg = $resultado == true ? 'Registro atualizado com sucesso.' : 'Ocorreu algum erro, registro não foi atualizado.';
        $alert = $resultado == true ? 'success' : 'danger';
        //$tratamentos = Tratamento::all();
        //return view('lista_tratamento', [ 'msg' => $msg, 'alert' => $alert, 'tratamentos' => $tratamentos ]);
        return redirect()->route('tratamento.index')->with('msg', $msg)->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletado = Tratamento::find($id)->delete();

        $msg = $deletado == true ? 'Registro deletado com sucesso.' : 'Ocorreu algum erro, registro não deletado.';
        $alert = $deletado == true ? 'success' : 'danger';
        return redirect()->route('tratamento.index')->with('msg', $msg)->with('alert', $alert);
    }
}
