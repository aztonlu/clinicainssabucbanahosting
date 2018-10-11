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
<body id="app-layout" >
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
                    <li class="active"><a href="citas">Citas</a></li>
                    <li class=""><a href="busquedaRapida">Consulta del día</a></li>
                    <li><a href="odontograma">Odontograma</a></li>
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
    <div class="panel-heading" align="right" id="headpnl">
       <form class="navbar-form">
       <input type="date" class="form-control" name="filtro" id="filtro">

         <div class="input-group">
           
           <span class="input-group-addon" style="background-color:#5bc0de;color:#fff"><i class="glyphicon glyphicon-search"></i></span>
           <input type="text" class="form-control" placeholder="Buscar por dni" id="searchDNI" name="searchDNI">

            <span class="input-group-addon" style="background-color:#5bc0de;color:#fff"><i class="glyphicon glyphicon-search"></i></span>
            <input type="text" class="form-control" placeholder="Buscar por apellido paterno" id="search" name="search">
          </div>
       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon glyphicon-plus"></i></button>
       <button type="button" class="btn btn-info" onclick = "location='/citas'"><i class="glyphicon glyphicon-refresh" ></i></button>
       </form>

     </div>
     <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">¿A que paciente quieres realizar la cita?</h4>

            </div>
            <div class="modal-body">
              <div class="input-group">
                <span class="input-group-addon" style="background-color:#5bc0de;color:#fff"><i class="glyphicon glyphicon-search"></i></span>
                <input type="text" class="form-control" placeholder="Buscar por dni" id="searchDNIModal" name="searchDNIModal">
                 <span class="input-group-addon" style="background-color:#5bc0de;color:#fff"><i class="glyphicon glyphicon-search"></i></span>
                 <input type="text" class="form-control" placeholder="Buscar por apellido paterno" id="searchModal" name="searchModal">

               </div>
               <table class="table table-striped">
               <thead>
                 <tr>
                   <th>Dni</th>
                   <th>Nombres</th>
                   <th>Apellido Paterno</th>
                   <th>Apellido Materno</th>
                   <th>Cita</th>
                 </tr>
               </thead>
               <tbody class="tbody1">
               </tbody>
             </table>
            </div>
          </div>

        </div>
      </div>
     @if(session('success'))
       <div class="alert alert-success">
           {{ session('success')}}
       </div>
     @endif
    <div class="panel-body">
      <div class="table-responsive">
        <div class="paciente">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Dni</th>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Lugar</th>
                <th>Fecha Cita</th>
                <th>Editar</th>
                <th>Crear Historial</th>
                <th>Estado</th>
                <th>Detalle</th>
              </tr>
            </thead>
            <tbody class="tbody0">
              <?php foreach ($citas as $cita) {
                ?>
                <tr>
                  <td>{{ $cita->dni }}</td>
                  <td>{{ $cita->nombres }}</td>
                  <td>{{ $cita->apPaterno }}</td>
                  <td>{{ $cita->apMaterno }}</td>
                  <td>{{ $cita->lugar }}</td>
                  <td>{{ $cita->fechaCita }}</td>
                  <td>
                    <form action="modificarCita" method="GET">
                      <input type="hidden" name="idCita" id="idCita" value="{{ $cita->idCita}}">
                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                    </form>
                  </td>
                  <td>
                    <center>
                      <form action="realizarHistorial" method="GET">
                        <input type="hidden" name="dni" id="dni" value="{{$cita->dni}}">
                        <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right"></i></button>
                      </form>
                    </center>
                  </td>
                  <?php if( $cita->estado == "Atendido") {?>
                  <td class="success">
                    <center>
                        <button type="button" style="background-color:transparent;color:#000;border-color:#000"  class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>
                        {{ $cita->estado }}
                    </center>
                  </td>
                      <?php } if ($cita->estado == "Por Atender") { ?>
                  <td class="danger">
                      <center>
                        <button type="button" style="background-color:transparent;color:#000;border-color:#000"  class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>
                        {{ $cita->estado }}
                    </center>


                  </td>
                  <?php } if ($cita->estado == "Faltante") { ?>
                    <td class="danger">
                        <center>
                          <button type="button" style="background-color:transparent;color:#000;border-color:#000"  class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>
                          {{ $cita->estado }}
                      </center>
                    </td>
                      <?php } ?>
                      <td >
                    <center>
                      <form action="mostrarReporte" method="GET">
                        <input type="hidden" name="dni" id="dni" value="{{$cita->dni}}">
                        <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list" align="right"></i></button>
                      </form>
                    </center>
                  </td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
          {!! $citas->links() !!}
        </div>
      </div>
    </div>
    </html>



    <!-- JavaScripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">

      $('#search').on('keyup',function(){
        document.getElementById('searchDNI').value="";
        $value=$(this).val();
        $.ajax({
          type : "get",
          url :"searchCitas",
          data : {'search':$value},
          success:function(data){
            $('.tbody0').html(data);
          }
        });
      });
      $('#searchDNI').on('keyup',function(){
        document.getElementById('search').value="";
        $value=$(this).val();
        $.ajax({
          type : "get",
          url :"searchCitas",
          data : {'search':$value,'status':"dni"},
          success:function(data){
            $('.tbody0').html(data);
          }
        });
      });
    </script>
    <script type="text/javascript">

      $('#searchModal').on('keyup',function(){
        document.getElementById('searchDNIModal').value="";
        $value=$(this).val();
        $.ajax({
          type : "get",
          url :"searchPacienteCita",
          data : {'search':$value},
          success:function(data){
            $('.tbody1').html(data);
          }
        });
      });
      $('#searchDNIModal').on('keyup',function(){
        document.getElementById('searchModal').value="";
        $value=$(this).val();
        $.ajax({
          type : "get",
          url :"searchPacienteCita",
          data : {'search':$value,'status':"dni"},
          success:function(data){
            $('.tbody1').html(data);
          }
        });
      });

      var date_input = document.getElementById('filtro');
      date_input.valueAsDate = new Date();

      date_input.onchange = function(){
         $.ajax({
            type : "get",
            url :"getCitasHoy",
            data : {'fecha': this.value},
            success:function(data){
              $('.tbody0').html(data);
            }
          });
      }
    </script>
</body>
