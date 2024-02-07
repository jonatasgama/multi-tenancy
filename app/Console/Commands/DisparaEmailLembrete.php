<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\Email;

class DisparaEmailLembrete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emaillembrete:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispara email com lembrete da consulta';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $consultas = DB::select('select p.email, p.nome, inicio_consulta, cast(c.inicio_consulta as date) as data_consulta from consultas c inner join pacientes p on c.paciente_id = p.id
        where cast(inicio_consulta as date) = cast((now() + interval 1 day) as date)');
        
        foreach($consultas as $consulta){
            $emailData = [
                'title' => 'Sua consulta está chegando.',
                'body' => "Olá, $consulta->nome você tem uma consulta agendada para amanhã às " .date("H:i", strtotime($consulta->inicio_consulta)).  " horas."
            ];
    
            Mail::to($consulta->email)->send(new Email($emailData));
        }
        
    }
}
