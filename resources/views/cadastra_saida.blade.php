@extends('basico')

@section('conteudo')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Registrar Saida</h1>
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
                            <form class="user" action="{{ route('saida.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Item:
                                        <select name="gasto_id" id="gasto_id" class="form-control">
                                            @foreach($gastos as $gasto)
                                            <option value="{{ $gasto->id }}"> {{ $gasto->item }} R$ {{ number_format($gasto->valor, 2, ",", ".") }}</option>
                                            @endforeach
                                        </select> 
                                        {{ $errors->has('gasto_id') ? $errors->first('gasto_id') : '' }}
                                    </div>

                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Quantidade:
                                        <input type="number" class="form-control" name="quantidade" id="quantidade"
                                            placeholder="quantidade" value="{{ $gasto->quantidade ?? old('quantidade') }}" required>
                                            {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                                    </div>  
                                                                      
                                    <div class="col-sm-4">
                                        Data de saída:
                                        <input type="date" class="form-control" name="data_saida" id="data_saida"
                                            placeholder="" value="{{ $gasto->data_saida ?? old('data_saida') }}" max="{{ date('Y-m-d') }}" required>
                                            {{ $errors->has('data_saida') ? $errors->first('data_saida') : '' }}
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