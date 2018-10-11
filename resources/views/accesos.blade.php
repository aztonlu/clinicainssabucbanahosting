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
                    <li><a href="odontograma">Odontograma</a></li>
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
    <div class="panel-heading" align="right" id="headpnl">
      <form class="navbar-form">
      <button type="button" class="btn btn-info" onclick = "location='/formularioUsuario'"><i class="glyphicon glyphicon glyphicon-plus"></i></button>
      <button type="button" class="btn btn-info" onclick = "location='/accesos'"><i class="glyphicon glyphicon-refresh" ></i></button>
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

                <th>Nombres</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Lugar</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody class="tbody0">
              <?php foreach ($usuarios as $historial) {
                ?>
                <tr>

                  <td>{{ $historial->name }}</td>
                  <td>{{ $historial->email }}</td>
                  <td>{{ $historial->tipo }}</td>
                  <td>{{ $historial->lugar }}</td>

                  <td>
                    <center>
                      <form action="editarUsuario" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{$historial->id}}">
                        <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></button>
                      </form>
                    </center>
                  </td>
                  <td>
                    <center>
                      <form action="eliminarUsuario" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{$historial->id}}">
                        <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-trash"></i></button>
                      </form>
                    </center>
                  </td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </html>



    <!-- JavaScripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
