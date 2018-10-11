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
    <div class="panel-heading" align="right" id="headpnl">
       <form class="navbar-form">
         <div class="input-group">
           <span class="input-group-addon" style="background-color:#5bc0de;color:#fff"><i class="glyphicon glyphicon-search"></i></span>
           <input type="text" class="form-control" placeholder="Buscar por dni" id="searchDNI" name="searchDNI">

            <span class="input-group-addon" style="background-color:#5bc0de;color:#fff"><i class="glyphicon glyphicon-search"></i></span>
            <input type="text" class="form-control" placeholder="Buscar por apellido paterno" id="search" name="search">
          </div>
       <button type="button" class="btn btn-info" onclick = "location='/formPacienteSecretario'"><i class="glyphicon glyphicon glyphicon-plus"></i></button>
       <button type="button" class="btn btn-info" onclick = "location='/secretario'"><i class="glyphicon glyphicon-refresh" ></i></button>
       </form>

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
                <th>Celular</th>
                <th>Editar</th>
                <th>Cita</th>
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
                    <form action="modificarPacienteBuscadoSecretario" method="get">
                      <input type="hidden" name="dni" id="dni" value="{{$paciente->dni}}">
                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="realizarCitaSecretario" method="GET">
                      <input type="hidden" name="dni" id="dni" value="{{$paciente->dni}}">
                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-calendar" align="right"></i></button>
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
          url :"searchPacienteSecretario",
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
          url :"searchPacienteSecretario",
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
