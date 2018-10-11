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
                    <li><a href="secretario">Filiación</a></li>
                    <li class="active"><a href="secretariocitas">Citas</a></li>
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
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro de Citas</div>
                    <div class="panel-body">
                      <?php foreach ($pacientes as $paciente) { ?>
                        <form class="form-horizontal" role="form" method="POST" action="registroCitaSecretario">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                                <label for="nombres" class="col-md-4 control-label">Nombres: </label>

                                <div class="col-md-6">
                                    <input id="nombres" type="text" class="form-control" name="nombres" value="{{ $paciente->nombres }}">

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
                                    <input id="apPaterno" type="apPaterno" class="form-control" name="apPaterno" value="{{ $paciente->apPaterno }}">

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
                                    <input id="apMaterno" type="apMaterno" class="form-control" name="apMaterno" value="{{ $paciente->apMaterno }}">

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
                                    <input id="dni" type="text" class="form-control" name="dni" value="{{ $paciente->dni }}" disabled>
                                    <input id="idPaciente" type="hidden" name="idPaciente" value="{{ $paciente->dni }}">
                                    @if ($errors->has('dni'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dni') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="numCitas" class="col-md-4 control-label">Número de Citas: </label>

                                <div class="col-md-6">
                                    <input id="numCitas" type="text" class="form-control" name="numCitas" value="<?php echo $numCitas; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('fechaCita') ? ' has-error' : '' }}">
                                <label for="fechaCita" class="col-md-4 control-label">Fecha Cita: </label>
                                <div class="col-md-6">
                                    <input id="fechaCita" type="date" class="form-control" name="fechaCita">

                                    @if ($errors->has('fechaCita'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fechaCita') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                                <label for="estado" class="col-md-4 control-label">Estado: </label>

                                <div class="col-md-6">
                                  <select class="form-control" id="estado" name="estado">
                                    <option>Por Atender</option>
                                    <option>Atendido</option>
                                    <option>Faltante</option>
                                  </select>
                                    @if ($errors->has('estado'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        </i> Guardar Cita
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
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
