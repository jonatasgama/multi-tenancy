@extends('basico')

@section('conteudo')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">{{ $funcao }} Paciente</h1>
                    </div>
                    <hr>
                    @if(session('msg') && session('alert'))
                        <div class="alert alert-{{ session('alert') }} alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('msg') }}
                        </div>
                    @endif

                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('paciente.index') }}">Pacientes</a></li>
                            @if(isset($paciente))
                                <li class="breadcrumb-item active" aria-current="page">{{ $paciente->nome." ".$paciente->sobrenome }}</li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                          @endif
                        </ol>
                    </nav>

                    <div class="col-lg-12">
                        <div class="p-3">
                            @if(isset($paciente->id))
                            <form class="user" action="{{ route('paciente.update', [ 'paciente' => $paciente->id ]) }}" method="post">
                                @csrf
                                @method('PUT')
                            @else
                            <form class="user" action="{{ route('paciente.store') }}" method="post">
                                @csrf
                            @endif
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Nome:
                                        <input type="text" class="form-control" name="nome" id="nome"
                                            placeholder="Nome" value="{{ $paciente->nome ?? old('nome') }}" required>
                                    </div>

                                    <div class="col-sm-6">
                                        Sobrenome:
                                        <input type="text" class="form-control" name="sobrenome" id="sobrenome"
                                            placeholder="Sobrenome" value="{{ $paciente->sobrenome ?? old('sobrenome') }}" required>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Data de nascimento:
                                        <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento"
                                        value="{{ $paciente->dt_nascimento ?? old('dt_nascimento') }}" required>
                                    </div>

                                    <div class="col-sm-3">
                                        Telefone:
                                        <input type="text" class="form-control" name="telefone" id="telefone"
                                            placeholder="Telefone com DDD" value="{{ $paciente->telefone ?? old('telefone') }}" required>
                                    </div>

                                    <div class="col-sm-4">
                                        E-mail:
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="E-mail" value="{{ $paciente->email ?? old('email') }}" required>
                                            {{ $errors->first('email') ?? '' }}
                                    </div>

                                    <div class="col-sm-2">
                                        CEP:
                                        <input type="number" class="form-control" name="cep" id="cep"
                                            placeholder="CEP" value="{{ $paciente->cep ?? old('cep') }}" onblur="pesquisacep(this.value);" required>
                                    </div>

                                </div>

                                <div class="form-group row">
                                <div class="col-sm-4">
                                    Cidade:
                                        <input type="text" class="form-control" name="cidade" id="cidade"
                                            placeholder="Cidade" value="{{ $paciente->cidade ?? old('cidade') }}" required>
                                    </div>

                                    <div class="col-sm-8">
                                        Endereço:
                                        <input type="text" class="form-control" name="endereco" id="endereco"
                                            placeholder="Endereço" value="{{ $paciente->endereco ?? old('endereco') }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <div class="col-sm-4">
                                        Bairro:
                                        <input type="text" class="form-control" name="bairro" id="bairro"
                                            placeholder="Bairro" value="{{ $paciente->bairro ?? old('bairro') }}" required>
                                    </div>

                                    <div class="col-sm-4">
                                        Complemento:
                                        <input type="text" class="form-control" name="complemento" id="complemento"
                                            placeholder="Complemento" value="{{ $paciente->complemento ?? old('complemento') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        Canal origem
                                        <select class="custom-select" name="canal_origem_id">
                                            @if(isset($canais))
                                                @foreach ( $canais as $canal )
                                                    <option value="{{ $canal->id }}" {{ (isset($paciente->canalOrigem->id) and $paciente->canalOrigem->id == $canal->id) ? 'selected' : '' }}>{{ $canal->canal }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                </div>

                                <button class="btn btn-primary mb-4" type="submit">
                                    Salvar
                                </button>

                                @if(isset($paciente))
                                <button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#novaConsulta">
                                    Nova consulta
                                </button>
                                @endif
                            </form>

                            @if(isset($consultas))
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 text-primary">Consultas</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Data consulta</th>
                                                        <th>Tratamento</th>
                                                        <th>Inicio</th>
                                                        <th>Fim</th>
                                                        <th colspan="3" class="text-center">Opções</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Data consulta</th>
                                                        <th>Tratamento</th>
                                                        <th>Inicio</th>
                                                        <th>Fim</th>
                                                        <th colspan="3" class="text-center">Opções</th>
                                                    </tr>
                                                </tfoot>

                                                <tbody>
                                                    @foreach($consultas as $consulta)

                                                    <tr>
                                                        <td>{{ date("d/m/Y", strtotime($consulta->inicio_consulta)) }}</td>
                                                        <td>{{ $consulta->tratamento->tratamento }}</td>
                                                        <td>{{ date("H:i", strtotime($consulta->inicio_consulta)) }}</td>
                                                        <td>{{ date("H:i", strtotime($consulta->fim_consulta)) }}</td>
                                                        <td><button class="btn btn-info" data-toggle="modal" data-target="#atualizaConsulta" onclick="pegaConsulta({{ $consulta }})" {{ $consulta->pagamento == 'realizado' ? 'disabled' : '' }}>Editar</button></td>
                                                        <td>
                                                            <form id="form_{{ $consulta->id }}" method="post" action="/consulta/{{ $consulta->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="paciente_id" value="{{ $consulta->paciente_id }}">
                                                                <button class="btn btn-danger" onclick="document.getElementById('form_{{ $consulta->id }}').submit()" {{ $consulta->pagamento == 'realizado' ? 'disabled' : '' }}>Cancelar</button>
                                                            </form>
                                                        </td>

                                                    </tr>

                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

<!--                 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <form id="form_atualiza" method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <input type="hidden" name="paciente_id" id="paciente_id" value="" />
                                <input type="hidden" name="id" id="id" value="" />
                                <input type="hidden" name="consulta_id" id="consulta_id" value="" />
                                <div class="modal-body">
                                    <h4>Editar Consulta</h4>

                                    Início da consulta:
                                    <br />
                                    <input type="datetime-local" class="form-control" name="inicio_consulta" id="inicio_consulta">

                                    Fim da consulta:
                                    <br />
                                    <input type="datetime-local" class="form-control" name="fim_consulta" id="fim_consulta">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->

                @include('componentes.modal_editar_criar')

<script src="{{ asset('js/cep.js') }}"></script>
<script>

    function pegaConsulta(consulta){
        console.log(consulta);
        document.getElementById('a_inicio_consulta').value = consulta.inicio_consulta;
        document.getElementById('a_fim_consulta').value = consulta.fim_consulta;
        document.getElementById('a_id').value = consulta.id;
        document.getElementById('a_paciente_id').value = consulta.paciente_id;
        document.getElementById('a_tratamento_id').value = consulta.tratamento_id;
        document.getElementById('a_pagamento_id').value = consulta.pagamento_id;
        document.getElementById('a_pagamento').value = consulta.pagamento;
        consulta.pagamento == "realizado" ? document.getElementById('a_pagamento').setAttribute("disabled", true) : document.getElementById('a_pagamento').removeAttribute("disabled");
        document.getElementById('form_atualiza').setAttribute("action", "/consulta/"+consulta.id);
    }

</script>
@endsection
