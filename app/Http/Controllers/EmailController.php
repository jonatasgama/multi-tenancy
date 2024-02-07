<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Email;

class EmailController extends Controller
{

    public function index(Request $req){

        $consultas = DB::select('select p.email, p.nome, cast(c.inicio_consulta as date) as data_consulta,
        cast(c.inicio_consulta as time) as hora_consulta from consultas c inner join pacientes p on c.paciente_id = p.id
        where cast(inicio_consulta as date) = cast((now() + interval 1 day) as date)');

        $emailData = [
            'title' => 'Sua consulta está chegando.',
            'body' => "Olá, $nome você tem uma consulta agendada para amanhã às $horas horas, caso queira desmarcar por favor clique nesse link."
        ];

        Mail::to($email)->send(new Email($emailData));
    }
}
