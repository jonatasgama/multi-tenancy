@extends('basico')

@section('conteudo')

            <!-- Begin Page Content -->
            <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Pacientes</h1>
            @if(session('msg') && session('alert'))
                <div class="alert alert-{{ session('alert') }} alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('msg') }}
                </div>             
            @endif
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pacientes cadastrados</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Sobrenome</th>
                                            <th>Telefone</th>
                                            <th>E-mail</th>
                                            <th>Nascimento</th>
                                            <th colspan="2">Opções</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Nome</th>
                                            <th>Sobrenome</th>
                                            <th>Telefone</th>
                                            <th>E-mail</th>
                                            <th>Nascimento</th>
                                            <th colspan="2">Opções</th>
                                        </tr>
                                    </tfoot>
                                    @if(isset($pacientes))
                                    <tbody>
                                        @foreach($pacientes as $paciente)
                                        
                                        <tr>                                            
                                            <td>{{ $paciente->nome }}</td>
                                            <td>{{ $paciente->sobrenome }}</td>
                                            <td>{{ $paciente->telefone }}</td>
                                            <td>{{ $paciente->email }}</td>
                                            <td>{{ date("d/m/Y", strtotime($paciente->dt_nascimento)) }}</td>
                                            <td><a href="{{ route('paciente.show', ['paciente' => $paciente->id]) }}" class="btn btn-info">Visualizar</a></td>
                                        </tr>
                                        
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>                

            </div>
            <!-- /.container-fluid -->
 

<script src="{{ asset('js/cep.js') }}"></script>
@endsection