@extends('basico')

@section('conteudo')

            <!-- Begin Page Content -->
            <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Gastos</h1>
            @if(session('msg') && session('alert'))
                <div class="alert alert-{{ session('alert') }} alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('msg') }}
                </div>             
            @endif
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Itens cadastrados</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Valor</th>
                                            <th>Data de cadastro</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Item</th>
                                            <th>Valor</th>
                                            <th>Data de cadastro</th>
                                        </tr>
                                    </tfoot>
                                    @if(isset($gastos))
                                    <tbody>
                                        @foreach($gastos as $gasto)
                                        <tr>
                                            <td>{{ $gasto->item }}</td>
                                            <td>R$ {{ number_format($gasto->valor, 2, ",", ".") }}</td>
                                            <td>{{ date("d/m/Y", strtotime($gasto->created_at)) }}</td>
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