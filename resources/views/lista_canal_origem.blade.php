@extends('basico')

@section('conteudo')

            <!-- Begin Page Content -->
            <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Canais de Origem</h1>
            @if(session('msg') && session('alert'))
                <div class="alert alert-{{ session('alert') }} alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('msg') }}
                </div>             
            @endif
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Canal de Origem</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Canal</th>
                                            <th>Data de cadastro</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Canal</th>
                                            <th>Data de cadastro</th>
                                        </tr>
                                    </tfoot>
                                    @if(isset($canais))
                                    <tbody>
                                        @foreach($canais as $canal)
                                        <tr>
                                            <td>{{ $canal->canal }}</td>
                                            <td>{{ date("d/m/Y", strtotime($canal->created_at)) }}</td>
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