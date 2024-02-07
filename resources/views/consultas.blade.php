@extends('basico')

@section('conteudo')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                @if(session('msg') && session('alert'))
                <div class="alert alert-{{ session('alert') }} alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('msg') }}
                </div>             
                @endif
                    <div id='calendar'></div>

                </div>
                <!-- /.container-fluid -->
                
                @include('componentes.modal_editar_criar')                                

@endsection