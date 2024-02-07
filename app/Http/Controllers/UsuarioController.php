<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Consulta;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registrar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'sobrenome' => 'required|min:3',
            'email' => 'email',
            'senha' => 'required'
        ];

        $feedback = [
                'nome.min' => 'O campo nome precisa no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'sobrenome.min' => 'O campo nome precisa no mínimo 3 caracteres',
                'required' => 'O campo :attribute deve ser preenchido',
                'email' => 'O email deve estar em um formato válido'
        ];

        $req->validate($regras, $feedback);

        Usuario::create($req->all());

        return redirect()->route('index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
