@extends('basico')

@section('conteudo')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Cadastrar Cana de Origem</h1>
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
                            <form class="user" action="{{ route('canalorigem.store') }}" method="post">
                                @csrf
                                <div class="form-group row">                                                                    
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="canal" id="canal"
                                            placeholder="Canal de origem" value="{{ $gasto->item ?? old('canal') }}" required>
                                            {{ $errors->has('canal') ? $errors->first('canal') : '' }}
                                    </div>  
                                    
                                </div>
                                <button class="btn btn-primary btn-user" type="submit">
                                    Salvar
                                </button>
                            </form>
                        </div>
                    </div>                    

                </div>
                <!-- /.container-fluid -->

            

@endsection