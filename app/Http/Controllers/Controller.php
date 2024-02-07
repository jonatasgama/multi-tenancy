<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $req){

        $erro = '';

        if($req->get('erro') == 1){
            $erro = 'Usuário e/ou senha incorreto(s)';
        }

        if($req->get('erro') == 2){
            $erro = 'Necessário realizar login';
        }

        return view('login', ['erro' => $erro]);
    }

    public function registrar(){

        return view('registrar');
    }

    public function home(){

        return view('home');
    }

    public function login(Request $req){

        $regras = [
                'email' => 'email|required',
                'senha' => 'required'
        ];

        $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'email' => 'O email deve estar em um formato válido'
        ];

        $req->validate($regras, $feedback);

        $usuario = new Usuario();

        $email = $req->get('email');
        $senha = $req->get('senha');

        $usuario = $usuario->where('email', $email)->where('senha', $senha)->get()->first();

        if(isset($usuario->nome)){

            session_start();
            $_SESSION['nome'] = $usuario->nome;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('consulta.index');

        }else{
            return redirect()->route('index', [ 'erro' => 1 ]);
        }

        return redirect()->route('index');
    }

    public function sair(Request $request){
//        session_destroy();
        $request->session()->flush();
        return redirect()->route('index');
    }

    public function cadastraTratamento(){

        return view('cadastra_tratamento');
    }
}
