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
                <a class="navbar-brand" href="{{ url('home') }}">
                    <img src="img/hospital.png" width="30" height="30">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="home">Filiación</a></li>
                    <li><a href="citas">Citas</a></li>
                    <li><a href="busquedaRapida">Consulta del día</a></li>
                    <li><a href="recetas">Recetas</a></li>
                    <li class="active"><a href="accesos">Accesos</a></li>
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
                      <?php foreach ($usuarios as $user) { ?>
                        <form class="form-horizontal" role="form" method="POST" action="modificarUsuario">
                            {{ csrf_field() }}

                            <div class="col-sm-12">

                                <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                                    <label for="nombres" class="col-md-4 control-label">Nombres: </label>

                                    <div class="col-md-6">
                                        <input id="nombres" type="text" class="form-control" name="nombres" value="{{ $user->name}}">
                                        <input id="id" type="hidden" class="form-control" name="id" value="{{ $user->id}}">

                                        @if ($errors->has('nombres'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nombres') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email: </label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Contraseña: </label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" value="">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                                    <label for="tipo" class="col-md-4 control-label">Tipo: </label>

                                    <div class="col-md-6">
                                      <select class="form-control" id="tipo" name="tipo">
                                        <?php if($user->tipo == "administrador"){ ?>
                                        <option>administrador</option>
                                        <option>secretaria</option>
                                        <?php } ?>
                                        <?php if($user->tipo == "secretaria"){ ?>
                                        <option>secretaria</option>
                                        <option>administrador</option>
                                        <?php } ?>
                                      </select>
                                        @if ($errors->has('tipo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tipo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('lugar') ? ' has-error' : '' }}">
                                    <label for="lugar" class="col-md-4 control-label">Lugar: </label>

                                    <div class="col-md-6">
                                      <select class="form-control" id="lugar" name="lugar">
                                        <?php if($user->tipo == "administrador"){ ?>
                                        <option>-</option>
                                        <option>Clinica B</option>
                                        <?php } elseif ($user->tipo == "secretaria") {
                                        ?>
                                        <?php if($user->lugar == "Clinica A"){ ?>
                                        <option>Clinica A</option>
                                        <option>Clinica B</option>
                                        <?php } ?>
                                        <?php if($user->lugar == "Clinica B"){ ?>
                                        <option>Clinica B</option>
                                        <option>Clinica A</option>
                                        <?php }
                                      }?>
                                      </select>
                                        @if ($errors->has('lugar'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lugar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                         Guardar
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
