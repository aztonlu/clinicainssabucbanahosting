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
                    <li class="active"><a href="historial">Historiales</a></li>
                    <li class=""><a href="busquedaRapida">Consulta del día</a></li>
                    <li><a href="recetas">Recetas</a></li>
                    <li><a href="accesos">Accesos</a></li>
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
                    <div class="panel-heading">Registro de Historial Médico</div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="modificarHistorialForm" id="form2" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <?php foreach ($historiales as $paciente) { ?>
                          <div class="col-sm-12">
                            <div class="col-sm-6">

                              <div class="form-group{{ $errors->has('paciente') ? ' has-error' : '' }}">
                                  <label for="paciente" class="col-md-4 control-label">Paciente: </label>
                                  <div class="col-md-8">
                                      <input id="paciente" type="text" class="form-control" name="paciente" value="{{$paciente->apPaterno}} {{$paciente->apMaterno}}  {{$paciente->nombres}}" disabled>
                                      @if ($errors->has('paciente'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('paciente') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                                  <label for="dni" class="col-md-4 control-label">Dni: </label>

                                  <div class="col-md-8">
                                      <input id="" type="text" class="form-control" name="" value="{{$paciente->dni}}" disabled>
                                      <input id="dni" type="hidden" name="dni" value="{{$paciente->dni}}">
                                      <input id="idHistorial" type="hidden" name="idHistorial" value="{{$paciente->idHistorial}}">
                                      @if ($errors->has('dni'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('dni') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group{{ $errors->has('fechaHistorial') ? ' has-error' : '' }}">
                                  <label for="fechaHistorial" class="col-md-4 control-label">Fecha: </label>

                                  <div class="col-md-8">
                                      <input id="fechaHistorial" type="date" class="form-control" name="fechaHistorial" value="{{$paciente->fechaHistorial}}" disabled>
                                      @if ($errors->has('fechaHistorial'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('fechaHistorial') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('tiempoEnfermedad') ? ' has-error' : '' }}">
                                  <label for="tiempoEnfermedad" class="col-md-4 control-label">Tiempo de Enfermedad: </label>

                                  <div class="col-md-8">
                                      <input id="tiempoEnfermedad" type="text" class="form-control" name="tiempoEnfermedad" value="{{$paciente->tiempoEnfermedad}}" disabled>
                                      @if ($errors->has('tiempoEnfermedad'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('tiempoEnfermedad') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('formaInicio') ? ' has-error' : '' }}">
                                  <label for="formaInicio" class="col-md-4 control-label">Forma de inicio: </label>

                                  <div class="col-md-8">
                                      <textarea class="form-control" rows="5" id="formaInicio" name="formaInicio" disabled>{{$paciente->formaInicio}}</textarea>

                                      @if ($errors->has('formaInicio'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('formaInicio') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('curso') ? ' has-error' : '' }}">
                                  <label for="curso" class="col-md-4 control-label">Curso: </label>

                                  <div class="col-md-8">
                                      <input id="curso" type="text" class="form-control" name="curso" value="{{$paciente->curso}}" disabled>
                                      @if ($errors->has('curso'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('curso') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <input id="status" type="hidden" class="form-control" name="status" value="">
                              <div class="form-group{{ $errors->has('signos') ? ' has-error' : '' }}">
                                  <label for="signos" class="col-md-4 control-label">Signos y principales signos: </label>

                                  <div class="col-md-8">
                                      <textarea class="form-control" rows="6" id="signos" name="signos" disabled>{{$paciente->signos}}</textarea>

                                      @if ($errors->has('signos'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('signos') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group{{ $errors->has('relato') ? ' has-error' : '' }}">
                                  <label for="relato" class="col-md-2 control-label">Relato: </label>

                                  <div class="col-md-10">
                                      <textarea class="form-control" rows="4" id="relato" name="relato" disabled>{{$paciente->relato}}</textarea>

                                      @if ($errors->has('relato'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('relato') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('examenfisico') ? ' has-error' : '' }}">
                                  <label for="examenfisico" class="col-md-2 control-label">Examen Físico: </label>

                                  <div class="col-md-10">
                                      <textarea class="form-control" rows="4" id="examenfisico" name="examenfisico" disabled>{{$paciente->examenFisico}}</textarea>

                                      @if ($errors->has('examenfisico'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('examenfisico') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('examenAuxiliar') ? ' has-error' : '' }}">
                                  <label for="examenAuxiliar" class="col-md-2 control-label">Examenes Auxiliares: </label>

                                  <div class="col-md-8">
                                      <input id="titulo" type="text" class="form-control" name="titulo" value="" disabled>
                                      <input id="imagen" type="file" class="form-control" name="imagen" accept="image/*" disabled>


                                      <div class="panel-body">
                                        <div class="table-responsive">

                                            <table class="table table-striped">
                                              <thead>
                                                <tr>
                                                  <th>Imagen</th>
                                                  <th>Nombre Examen</th>
                                                </tr>
                                              </thead>
                                              <tbody class="tbody0">
                                                <?php foreach ($examenes as $examen) { ?>
                                                  <tr>
                                                    <td><img src="{{ $examen->rutaImagen}}" width="30" height="30"></td>
                                                    <td>{{ $examen->nombreExamen }}</td>
                                                  </tr>
                                                <?php } ?>
                                              </tbody>
                                            </table>

                                        </div>
                                      </div>

                                      @if ($errors->has('examenAuxiliar'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('examenAuxiliar') }}</strong>
                                          </span>
                                      @endif
                                  </div>

                              </div>
                              <div class="form-group{{ $errors->has('diagnostico') ? ' has-error' : '' }}">
                                  <label for="diagnostico" class="col-md-2 control-label">Diagnóstico: </label>

                                  <div class="col-md-10">
                                      <textarea class="form-control" rows="4" id="diagnostico" name="diagnostico" disabled>{{$paciente->diagnostico}}</textarea>

                                      @if ($errors->has('diagnostico'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('diagnostico') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('tratamiento') ? ' has-error' : '' }}">
                                  <label for="tratamiento" class="col-md-2 control-label">Tratamiento: </label>

                                  <div class="col-md-10">
                                      <textarea class="form-control" rows="4" id="tratamiento" name="tratamiento" disabled>{{$paciente->tratamiento}}</textarea>

                                      @if ($errors->has('tratamiento'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('tratamiento') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </form>
                      <center><button type="button" class="btn btn-primary" onclick = "location='/historial'">
                           salir
                      </button>


                      </center>
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
