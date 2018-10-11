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
                    <li class=""><a href="busquedaRapida">Consulta del día</a></li>
                    <li class="active"><a href="recetas">Recetas</a></li>
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
                <div class="panel panel-info">
                    <div class="panel-heading">
                      <center>Registro de Receta Médica</center>

                    </div>


                    <div class="panel-body">
                      <div class="col-sm-12">
                        <?php foreach ($cabeceras as $paciente) { ?>
                        <form action="updateReceta" method="POST" id="idUpdateReceta">
                          {{ csrf_field() }}
                          <input id="idReceta" class="form-control" name="idReceta" type="hidden" value="{{ $paciente->idReceta }}">
                        <div class="col-sm-6">

                          <label for="nombres" class="control-label">Paciente: </label>
                          <input id="nombres" class="form-control" name="nombres" value="{{ $paciente->apPaterno }} {{ $paciente->apMaterno}} {{$paciente->nombres}}" disabled>
                          <ul class="list-inline">
                            <li>
                              <label for="dni" class="control-label">Dni: </label>
                              <input id="dni" class="form-control" name="dni" value="{{ $paciente->dni }}" disabled>
                            </li>
                            <li>
                              <label for="fechaHoy" class="control-label">Fecha: </label>
                              <input id="fechaReceta" type="hidden" class="form-control" name="fechaReceta" value="{{ $paciente->fechaReceta}}" >
                              <input id="fecha" type="date" class="form-control" name="fecha" value="{{ $paciente->fechaReceta}}" disabled>
                            </li>
                          </ul>
                          <label for="diagnostico" class="control-label">Diagnostico: </label>
                          <textarea class="form-control" rows="5" id="diagnostico" name="diagnostico" required disabled>{{ $paciente->diagnostico}}</textarea>

                        </div>
                      </form>
                      <center>
                        <ul class="list-inline">
                          <li>
                            <button onclick = "location='/recetas'" class="btn btn-primary">
                                Salir
                            </button>
                          </li>
                          <li>
                            <form action="reporteReceta" method="GET">
                              <input type="hidden" name="idReceta" id="idReceta" value="{{ $paciente->idReceta }}">
                              <button onclick = "location='/recetas'" class="btn btn-primary">
                                  Imprimir
                              </button>
                            </form>
                          </li>
                        </ul>
                    </center>
                      <?php } ?>


                      </div>

                        <table class="table table-striped" id="dynamic_field">
                          <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Dosis</th>
                              <th>Via</th>
                              <th>Frec</th>
                              <th>Duración</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($cuerpos as $paciente) {
                              ?>

                              <tr>
                                <td>{{$paciente->nombreMedicamento}}</td>
                                <td>{{$paciente->dosis}}</td>
                                 <td>{{$paciente->via}}</td>
                                <td>{{$paciente->frecuencia}}</td>
                                <td>{{$paciente->duracion}}</td>


                              </tr>

                              <?php } ?>
                          </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>


    </div>


    </html>
    <!-- JavaScripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    function saveItem()
    {
      $nombreMedicamento = document.getElementById('nombreMedicamento').value;
      $dosis = document.getElementById('dosis').value;
      $via = document.getElementById('via').value;
      $frecuencia = document.getElementById('frecuencia').value;
      $duracion = document.getElementById('duracion').value;
      $idReceta = document.getElementById('idReceta').value;
      if($nombreMedicamento=="" || $dosis == "" || $via == "" || $frecuencia == "" || $duracion == "")
      {
        alert("Ingrese todos los datos");
      }
      else {
        $.ajax({
          type : "get",
          url :"saveItemReceta",
          data : {'nombreMedicamento': $nombreMedicamento,'dosis':$dosis,'via':$via,'frecuencia':$frecuencia,'duracion':$duracion,'idReceta':$idReceta},
          success:function(data){
            $('tbody').html(data);
            document.getElementById('nombreMedicamento').value = "";
            document.getElementById('dosis').value = "";
            document.getElementById('via').value = "";
            document.getElementById('frecuencia').value = "";
            document.getElementById('duracion').value = "";
            document.getElementById("nombreMedicamento").focus();
          }
        });
      }
    }
    function submitReceta()
    {
      if(confirm('¿Está seguro que desea guardar la receta?'))
      {
        document.getElementById("idUpdateReceta").submit();
      }
      else
      {
        return false;
      }
    }
    function confirmar1(idRecetaCuerpo)
    {
      $idRecetaCuerpo = idRecetaCuerpo;
      $idReceta = document.getElementById('idReceta').value;
      $.ajax({
        type : "get",
        url :"eliminarRecetaCuerpo",
        data : {'idRecetaCuerpo': $idRecetaCuerpo,'idReceta':$idReceta},
        success:function(data){
          $('tbody').html(data);
          document.getElementById("nombreMedicamento").focus();
        }
      });
    }
    </script>


</body>
