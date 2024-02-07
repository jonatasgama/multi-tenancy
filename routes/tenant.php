<?php

declare(strict_types=1);

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\SaidaController;
use App\Http\Controllers\TratamentoController;
use App\Http\Controllers\UsuarioController;
use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\ScopeSessions;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    ScopeSessions::class
])->group(function () {


    Route::get('/', [\App\Http\Controllers\Controller::class, 'index'])->name('index');
    Route::get('/index', [\App\Http\Controllers\Controller::class, 'index'])->name('index');
    Route::get('/registrar', [\App\Http\Controllers\Controller::class, 'registrar'])->name('registrar');
    Route::post('/registrar', [\App\Http\Controllers\Controller::class, 'registrarUsuario'])->name('registrar');
    Route::post('/login', [\App\Http\Controllers\Controller::class, 'login'])->name('login');
    Route::get('/usuario/create', [\App\Http\Controllers\UsuarioController::class, 'create'])->name('usuario.create');
    Route::post('/usuario', [\App\Http\Controllers\UsuarioController::class, 'store'])->name('usuario.store');
    Route::get('/cancela-consulta/{id}', [\App\Http\Controllers\ConsultaController::class, 'cancelaConsultaEmail'])->name('cancela.consulta.email');
    Route::delete('/cancela-consulta/{id}', [\App\Http\Controllers\ConsultaController::class, 'cancelaConsulta'])->name('cancela.consulta');


    Route::middleware('autenticacao:padrao,visitante')->group(function(){
        Route::get('/home', [\App\Http\Controllers\Controller::class, 'home'])->name('home');
        Route::get('/cadastra-tratamento', [\App\Http\Controllers\Controller::class, 'cadastraTratamento'])->name('cadastra-tratamento');
        Route::get('/sair', [\App\Http\Controllers\Controller::class, 'sair'])->name('sair');
        Route::resource('usuario', UsuarioController::class)->except(['create','store']);
        Route::resource('tratamento', TratamentoController::class);
        Route::resource('pagamento', PagamentoController::class);
        Route::resource('paciente', PacienteController::class);
        Route::resource('consulta', ConsultaController::class);
        Route::get('dash', [\App\Http\Controllers\ConsultaController::class, 'dash'])->name('consulta.dash');
        Route::get('dash-pie', [\App\Http\Controllers\ConsultaController::class, 'graficoPie'])->name('consulta.dashPie');
        Route::post('/consulta-ajax', [\App\Http\Controllers\ConsultaController::class, 'ajaxUpdate'])->name('consulta.ajaxUpdate');
        Route::post('/procurar-paciente', [\App\Http\Controllers\PacienteController::class, 'procurar'])->name('paciente.procurar');
        Route::resource('gasto', GastoController::class);
        Route::resource('saida', SaidaController::class);
        Route::post('/pesquisar-item-mes', [\App\Http\Controllers\SaidaController::class, 'pesquisarItemPorMes'])->name('saida.pesquisaritemmes');
        Route::get('/item-mes', [\App\Http\Controllers\SaidaController::class, 'itemPorMes'])->name('saida.itemmes');
        Route::post('/pesquisar-gastos-mes', [\App\Http\Controllers\SaidaController::class, 'pesquisarGastosPorMes'])->name('saida.pesquisargastosmes');
        Route::get('/gastos-mes', [\App\Http\Controllers\SaidaController::class, 'gastosPorMes'])->name('saida.gastosmes');
        Route::post('/pesquisar-gastos-receitas', [\App\Http\Controllers\SaidaController::class, 'pesquisarGastoseReceitas'])->name('saida.pesquisargastosereceitas');
        Route::get('/gastos-e-receita', [\App\Http\Controllers\SaidaController::class, 'gastosEReceita'])->name('saida.gastosereceita');
        Route::post('/canal-origem', [\App\Http\Controllers\CanalOrigemController::class, 'store'])->name('canalorigem.store');
        Route::get('/canal-origem', [\App\Http\Controllers\CanalOrigemController::class, 'index'])->name('canalorigem.index');
        Route::get('/canal-origem-create', [\App\Http\Controllers\CanalOrigemController::class, 'create'])->name('canalorigem.create');
    });

});
