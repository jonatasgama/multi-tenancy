@extends('basico')

@section('conteudo')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $funcao }} Tratamento</h1>
                    </div>
                    <hr>
                    @if(session('msg') && session('alert'))
                        <div class="alert alert-{{ session('alert') }} alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('msg') }}
                        </div>             
                    @endif
                    <div class="col-lg-12">
                        <div class="p-5">
                            @if(isset($tratamento->id))
                            <form class="user" action="{{ route('tratamento.update', [ 'tratamento' => $tratamento->id ]) }}" method="post">
                                @csrf
                                @method('PUT')
                            @else
                            <form class="user" action="{{ route('tratamento.store') }}" method="post">
                                @csrf
                            @endif
                                <div class="form-group row">                                                                    
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="tratamento" id="tratamento"
                                            placeholder="Tratamento" value="{{ $tratamento->tratamento ?? old('tratamento') }}" required>
                                    </div>  
                                                                      
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="valor" id="valor"
                                            placeholder="Valor" value="{{ $tratamento->valor ?? old('valor') }}" required>
                                    </div>
                                    
                                </div>
                                <button class="btn btn-primary btn-user" type="submit">
                                    {{ $funcao }}
                                </button>
                            </form>
                        </div>
                    </div>                    

                </div>
                <!-- /.container-fluid -->

            

@endsection