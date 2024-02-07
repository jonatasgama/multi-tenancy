@extends('basico')

@section('conteudo')

            <!-- Begin Page Content -->
            <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Pagamentos</h1>
            @if(isset($msg) && isset($alert))
                <div class="alert alert-{{ $alert }} alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $msg }}
                </div>             
            @endif
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pagamentos cadastrados</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Forma de pagamento</th>
                                            <th>Data de cadastro</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Forma de pagamento</th>
                                            <th>Data de cadastro</th>
                                        </tr>
                                    </tfoot>
                                    @if(isset($pagamentos))
                                    <tbody>
                                        @foreach($pagamentos as $pagamento)
                                        <tr>
                                            <td>{{ $pagamento->forma_pagamento }}</td>
                                            <td>{{ date("d/m/Y", strtotime($pagamento->created_at)) }}</td>
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

            

@endsection