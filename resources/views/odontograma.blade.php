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
    nav{
      background: url('img/fondo.jpg');
    }
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
                    <ul class="nav navbar-nav">
                    <li><a href="home"><b>Filiación</b></a></li>
                    <li><a href="citas">Citas</a></li>
                    <li><a href="busquedaRapida">Consulta del día</a></li>
                    <li class="active"><a href="odontograma">Odontograma</a></li>
                    <li><a href="accesos">Accesos</a></li>
                </ul>
                </ul>

              
            </div>
        </div>
    </nav>
    
    <div class="panel-heading" align="right" id="headpnl">
       <form class="navbar-form">

         <div class="input-group">
           
           <span class="input-group-addon" style="background-color:#5bc0de;color:#fff"><i class="glyphicon glyphicon-search"></i></span>
           <input type="text" class="form-control" placeholder="Buscar por dni" id="searchDNI" name="searchDNI">

            <span class="input-group-addon" style="background-color:#5bc0de;color:#fff"><i class="glyphicon glyphicon-search"></i></span>
            <input type="text" class="form-control" placeholder="Buscar por apellido paterno" id="search" name="search">
          </div>
       
       </form>

     </div>
    
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
                <th>Celular</th>
                <th>Odontograma</th>
                <th>Detalle</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pacientes as $paciente) {
                ?>

                <tr>
                  <td>{{$paciente->dni}}</td>
                  <td>{{$paciente->nombres}}</td>
                   <td>{{$paciente->apPaterno}}</td>
                  <td>{{$paciente->apMaterno}}</td>
                  <td>{{$paciente->telefono}}</td>
                  <td>
                    <form action="prueba" method="GET">
                      <input type="hidden" name="dni" id="dni" value="{{$paciente->dni}}">
                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right"></i></button>
                    </form>
                    <form action="nuevoOdontograma" method="GET">
                      <input type="hidden" name="dni" id="dni" value="{{$paciente->dni}}">
                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-plus" align="right"></i></button>
                    </form>
                  </td>
                  <td>
                    <!--<form action="detalleOdontograma" method="GET">-->
                      <form action="mostrarReporte" method="GET">
                      <input type="hidden" name="dni" id="dni" value="{{$paciente->dni}}">
                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-file" align="right"></i></button>
                    </form>
                  </td>

                </tr>

                <?php } ?>

            </tbody>
          </table>
          {!! $pacientes->links() !!}
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
          url :"searchPacienteodontograma",
          data : {'search':$value},
          success:function(data){
            $('tbody').html(data);
          }
        });
      });
      $('#searchDNI').on('keyup',function(){
        document.getElementById('search').value="";
        $value=$(this).val();
        $.ajax({
          type : "get",
          url :"searchPacienteodontograma",
          data : {'search':$value,'status':"dni"},
          success:function(data){
            $('tbody').html(data);
          }
        });
      });
    </script>
    <script>
      function confirmar()
      {
      	if(confirm('¿Está seguro que desea eliminar este paciente?'))
      	{
      		document.getElementById("formularioDelete").submit();
      	}
      	else
      	{
      		return false;
      	}
      }
      function confirmar1()
      {
      	if(confirm('¿Está seguro que desea eliminar este paciente?'))
      	{
      		document.getElementById("formularioDeleteBuscado").submit();
      	}
      	else
      	{
      		return false;
      	}
      }
      </script>
</body>
