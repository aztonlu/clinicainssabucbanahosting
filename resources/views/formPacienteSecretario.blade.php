<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Clínica</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="css/font-awesome.min.css">


    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        #search{width: 200px}
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('secretario') }}">
                    <img src="img/hospital.png" width="30" height="30">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="active"><a href="secretario">Filiación</a></li>
                    <li><a href="secretariocitas">Citas</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Ingreso</a></li>
                        <li><a href="{{ url('/register') }}">Registro</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"></i>Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro de Pacientes</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="registroPacienteSecretario">
                            {{ csrf_field() }}

                            <div class="col-sm-12">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                                    <label for="nombres" class="col-md-4 control-label">Nombres: </label>

                                    <div class="col-md-6">
                                        <input id="nombres" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}">

                                        @if ($errors->has('nombres'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nombres') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('apPaterno') ? ' has-error' : '' }}">
                                    <label for="apPaterno" class="col-md-4 control-label">Apellido Paterno: </label>

                                    <div class="col-md-6">
                                        <input id="apPaterno" type="apPaterno" class="form-control" name="apPaterno" value="{{ old('apPaterno') }}">

                                        @if ($errors->has('apPaterno'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('apPaterno') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('apMaterno') ? ' has-error' : '' }}">
                                    <label for="apMaterno" class="col-md-4 control-label">Apellido Materno: </label>

                                    <div class="col-md-6">
                                        <input id="apMaterno" type="apMaterno" class="form-control" name="apMaterno">

                                        @if ($errors->has('apMaterno'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('apMaterno') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                                    <label for="dni" class="col-md-4 control-label">Dni: </label>

                                    <div class="col-md-6">
                                        <input id="dni" type="number" class="form-control" name="dni">

                                        @if ($errors->has('dni'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dni') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                    <label for="direccion" class="col-md-4 control-label">Dirección: </label>

                                    <div class="col-md-6">
                                        <input id="direccion" type="text" class="form-control" name="direccion">

                                        @if ($errors->has('direccion'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                    <label for="telefono" class="col-md-4 control-label">Telefono: </label>

                                    <div class="col-md-6">
                                        <input id="telefono" type="text" class="form-control" name="telefono">

                                        @if ($errors->has('telefono'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('edad') ? ' has-error' : '' }}">
                                    <label for="edad" class="col-md-4 control-label">Edad: </label>

                                    <div class="col-md-6">
                                        <input id="edad" type="number" class="form-control" name="edad">

                                        @if ($errors->has('edad'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('edad') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}">
                                    <label for="sexo" class="col-md-4 control-label">Sexo: </label>

                                    <div class="col-md-6">
                                      <select class="form-control" id="sexo" name="sexo">
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                      </select>
                                        @if ($errors->has('sexo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sexo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('estadoCivil') ? ' has-error' : '' }}">
                                    <label for="estadoCivil" class="col-md-4 control-label">Estado Civil: </label>

                                    <div class="col-md-6">
                                      <select class="form-control" id="estadoCivil" name="estadoCivil">
                                        <option>Soltero</option>
                                        <option>Casado</option>
                                        <option>Divorciado</option>
                                        <option>Viudo</option>
                                      </select>
                                        @if ($errors->has('estadoCivil'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('estadoCivil') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('antecedentes') ? ' has-error' : '' }}">
                                    <label for="antecedentes" class="col-md-4 control-label">Antecedentes: </label>

                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="8" id="antecedentes" name="antecedentes"></textarea>

                                        @if ($errors->has('antecedentes'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('antecedentes') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </html>
    <!-- JavaScripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
