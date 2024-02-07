<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cancelar Consulta</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                            <div class="col-lg-8 offset-2">
                                <div class="p-5">
                                    @if(isset($msg))
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ $msg }}</h1>                               
                                    </div>
                                    @else
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Deseja realmente cancelar a consulta?</h1>
                                        {{ isset($erro) && $erro != '' ? $erro : '' }}
                                    </div>
                                    <form class="user" action="/cancela-consulta/{{ base64_encode($consulta->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="paciente_id" value="{{ base64_encode($consulta->paciente_id) }}">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nome</label>
                                            <div class="col-sm-10">
                                                <input type="name" class="form-control-plaintext"
                                                value="{{ $consulta->paciente->nome }}" readonly>
                                            </div>    
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Data</label>
                                            <div class="col-sm-10">
                                                <input type="name" class="form-control-plaintext"
                                                value="{{ date('d/m/Y', strtotime($consulta->inicio_consulta)) }}" readonly>
                                            </div>    
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Horário</label>
                                            <div class="col-sm-10">
                                                <input type="name" class="form-control-plaintext"
                                                value="{{ date('H:i', strtotime($consulta->inicio_consulta)) }}" readonly>
                                            </div>    
                                        </div>        
                                        Confirme sua data de nascimento
                                        <div class="form-group row">
                                            <div class="col-sm-5">
                                                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required>
                                            </div>                                                
                                        </div>      
                                        {{ $errors->has('data_nascimento') ? $errors->first('data_nascimento') : '' }}                                                                    
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Cancelar
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ ('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ ('js/sb-admin-2.min.js') }}"></script>

</body>

</html>