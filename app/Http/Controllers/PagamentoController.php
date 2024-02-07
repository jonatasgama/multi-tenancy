<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $pagamentos = Pagamento::all();
        return view('lista_pagamento', [ 'pagamentos' => $pagamentos ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cadastra_pagamento', ['funcao' => 'Cadastrar']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $regras = [
            'forma_pagamento' => 'required|min:3'
        ];

        $feedback = [
                'forma_pagamento.min' => 'O campo tratamento precisa de no mínimo 3 caracteres',
                'required' => 'O campo :attribute deve ser preenchido'
        ];

        $req->validate($regras, $feedback);

        $resultado = Pagamento::create($req->all());

        $msg = $resultado == true ? 'Registro cadastrado com sucesso.' : 'Ocorreu algum erro, registro não cadastrado.';
        $alert = $resultado == true ? 'success' : 'danger';
        return view('cadastra_pagamento', [ 'msg' => $msg, 'alert' => $alert, 'funcao' => 'Cadastrar' ]);
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
        $pagamento = Pagamento::find($id);
        return view('cadastra_pagamento', [ 'funcao' => 'Editar', 'pagamento' => $pagamento ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $regras = [
            'forma_pagamento' => 'required|min:3'
        ];

        $feedback = [
                'forma_pagamento.min' => 'O campo tratamento precisa de no mínimo 3 caracteres',
                'required' => 'O campo :attribute deve ser preenchido'
        ];

        $req->validate($regras, $feedback);

        $resultado = Pagamento::find($id);
        $resultado->update($req->all());

        $msg = $resultado == true ? 'Registro atualizado com sucesso.' : 'Ocorreu algum erro, registro não atualizado.';
        $alert = $resultado == true ? 'success' : 'danger';
        $pagamentos = Pagamento::all();
        return view('lista_pagamento', [ 'msg' => $msg, 'alert' => $alert, 'pagamentos' => $pagamentos ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletado = Pagamento::find($id)->delete();

        $msg = $deletado == true ? 'Registro deletado com sucesso.' : 'Ocorreu algum erro, registro não deletado.';
        $alert = $deletado == true ? 'success' : 'danger';
        $pagamentos = Pagamento::all();
        return view('lista_pagamento', [ 'msg' => $msg, 'alert' => $alert, 'pagamentos' => $pagamentos ]);
    }
}
