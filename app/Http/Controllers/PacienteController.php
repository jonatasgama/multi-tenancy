<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Consulta;
use App\Models\Tratamento;
use App\Models\Pagamento;
use App\Models\CanalOrigem;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $pacientes = Paciente::all();
        return view('lista_paciente', [ 'pacientes' => $pacientes ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tratamentos = Tratamento::all();
        $pagamentos = Pagamento::all();
        $canais = CanalOrigem::all();
        return view('cadastra_paciente',
        [
            'funcao' => 'Salvar',
            'tratamentos' => $tratamentos,
            'pagamentos' => $pagamentos,
            'canais' => $canais
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'sobrenome' => 'required|min:3',
            'email' => 'unique:pacientes,email'
        ];

        $feedback = [
            'nome.min' => 'O campo nome precisa no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'sobrenome.min' => 'O campo nome precisa no mínimo 3 caracteres',
            'required' => 'O campo :attribute deve ser preenchido',
            'email.unique' => 'Esse e-mail já está sendo utilizado.'
        ];
        $req->validate($regras, $feedback);

        $resultado = Paciente::create($req->all());

        $msg = $resultado == true ? 'Paciente cadastrado com sucesso.' : 'Ocorreu algum erro, paciente não cadastrado.';
        $alert = $resultado == true ? 'success' : 'danger';
        return redirect()->route('paciente.create')->with('msg', $msg)->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paciente = Paciente::with(['canalOrigem'])->where(['id' => $id])->first();
        $consultas = Consulta::where('paciente_id', $id)->orderBy('inicio_consulta')->get();
        $tratamentos = Tratamento::all();
        $pagamentos = Pagamento::all();
        $canais = CanalOrigem::all();
        return view('cadastra_paciente',
        [
            'funcao' => 'Visualizar',
            'paciente' => $paciente,
            'consultas' => $consultas,
            'tratamentos' => $tratamentos,
            'pagamentos' => $pagamentos,
            'canais' => $canais
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paciente = Paciente::find($id);
        return view('cadastra_paciente', [ 'funcao' => 'Editar', 'paciente' => $paciente ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'sobrenome' => 'required|min:3',
        ];

        $feedback = [
            'nome.min' => 'O campo nome precisa no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'sobrenome.min' => 'O campo nome precisa no mínimo 3 caracteres',
            'required' => 'O campo :attribute deve ser preenchido',
        ];

        $req->validate($regras, $feedback);

        $resultado = Paciente::find($id);
        $resultado->update($req->all());

        $msg = $resultado == true ? 'Paciente atualizado com sucesso.' : 'Ocorreu algum erro, registro não foi atualizado.';
        $alert = $resultado == true ? 'success' : 'danger';
        return redirect()->route('paciente.index')->with('msg', $msg)->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletado = Paciente::find($id)->delete();

        $msg = $deletado == true ? 'Paciente deletado com sucesso.' : 'Ocorreu algum erro, registro não deletado.';
        $alert = $deletado == true ? 'success' : 'danger';
        return redirect()->route('paciente.index')->with('msg', $msg)->with('alert', $alert);
    }

    public function procurar(Request $req)
    {
        $pacientes = new Paciente();

        $nome = $req->get('nome');

        $pacientes = $pacientes->where('nome', 'like', "%$nome%")->get();

        return view('lista_paciente', [ 'pacientes' => $pacientes ]);
    }
}
