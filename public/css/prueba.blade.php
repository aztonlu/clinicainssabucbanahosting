<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <title>Spart</title>
        <link rel="shortcut icon" href="img/favicon.png">

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/customevento.css" rel="stylesheet">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
        <link href="css/new-age.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
            </head>
    <body onresize="tamanho()">
    <div style="padding-top: 3%">
      <nav id="mainNav" class="navbar navbar-default1 navbar-fixed-top">
          <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="color:#fff;">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="/" style="padding-bottom: 3px;padding-top: 0"><img src="img/logo_spart.png"></a>
                </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                 
                  <ul class="nav navbar-nav navbar-right">
                        <li style="padding-top:2%;" id="liBusqueda">
                              <form method="POST" action="search" id="searchEvento">
                                {{ csrf_field() }}
                                <input type="text" name="search" id="search" class="form-control" placeholder="Busca tu evento..." style="font-size:6pt; background-color:#1C1C1F; color:#fff;">
                              </form>
                            </li>
                        @if (Auth::guest())
                            
                           <li>
                                <a><span class="menu">Ayuda</span><i class="fa fa-question-circle"></i></a>    
                            </li>

                            <li class="dropdown">

                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="menu">Buscar</span><i class="fa fa-search"></i><span class="caret"></span></a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a onclick="callinputSearch()">Nombre</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="evento">Categoría</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="filtroFechas">Fecha</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="filtroMapasHome">Ubicación</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">

                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="menu">Menú</span><i class="fa fa-bars"></i><span class="caret"></span></a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/registeruser') }}">Registro</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ url('/login') }}">Iniciar Sesión</a>
                                    </li>
                                </ul>
                            </li>                            

                           
                            <li>
                            <a href="#footer"><span class="menu">Más</span><i class="fa fa-cog"></i></a>
                            </li>

                        @else

                            <li>
                                <a><span class="menu">Ayuda</span><i class="fa fa-question-circle"></i></a>    
                            </li>

                            <li class="dropdown">

                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="menu">Buscar</span><i class="fa fa-search"></i><span class="caret"></span></a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a onclick="callinputSearch()">Nombre</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="evento">Categoría</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="filtroFechas">Fecha</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="filtroMapasHome">Ubicación</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img height="30" width="30" class="img-circle" src="{{ Auth::user()->avatar }}"><span class="caret"></span></a>

                                <ul class="dropdown-menu" role="menu">                        
                                    <li>
                                        <a href="getHistorialUser">Mis Eventos</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="getFavoritesUser">Favoritos</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout') }}">Salir</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                 <a href="#footer"><span class="menu">Más</span><i class="fa fa-cog"></i></a>
                            </li>


                        @endif

                    </ul>
                  
                  
              </div>
              <!-- /.navbar-collapse -->
          </div>
          <!-- /.container-fluid -->
      </nav>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="col-sm-6">
                <div id="imagen1">
                    <a href="gettodos"><img src="img/todo2-2.png" height="91%" width="91%" ></a>
                    <div align="center" id="divImagen1"><a href="gettodos">TODOS</a></div>
                 </div> 
            </div>
            <div class="col-sm-6">
              <div class="col-sm-12">
              <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getmusica"><img src="img/musica2.png" height="100%" width="100%"></a>
                    <div align="center"><a href="getmusica">MÚSICA</a></div>
                  </div>    
                </div>
                <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getnarracion"><img src="img/narracion2.png" height="100%" width="100%"></a>
                    <div align="center"><a href="getnarracion">NARRACIÓN</a></div>
                  </div>    
                </div>
                <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getteatro"><img src="img/teatro2.png" height="100%" width="100%"></a>
                    <div align="center"><a href="getteatro">TEATRO</a></div>
                  </div>    
                </div>
                <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getdanza"><img src="img/danza2.png" height="100%" width="100%"></a>
                    <div align="center"><a href="getdanza">DANZA</a></div>
                  </div>    
                </div>
                <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getartesgraficas"><img src="img/artes-graficas2.png" height="100%" width="100%"></a>
                    <div align="center"><a href="getartesgraficas">ARTES GRÁFICAS</a></div>
                  </div>    
                </div>
                <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getfotografia"><img src="img/fotografia2.png" height="100%" width="100%"></a>
                    <div align="center"><a href="getfotografia">FOTOGRAFÍA</a></div>
                  </div>    
                </div>
                <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getliteratura"><img src="img/literatura2.png" height="100%" width="100%"></a>
                    <div align="center"><a href="getliteratura">LITERATURA</a></div>
                  </div>    
                </div>
                <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getescultura"><img src="img/escultura2.png" height="100%" width="100%"></a>
                    <div align="center"><a href="getescultura">ESCULTURA</a></div>
                  </div>    
                </div>
                <div class="col-sm-4">
                  <div id="imagen">
                    <a href="getotros"><img src="img/otros2.png" height="100%" width="100%" ></a>
                    <div align="center"><a href="getotros">OTROS</a></div>
                  </div>    
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>


       
      <div class="modal fade" id="myModalEvento" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="mhc" align="right">
                  <button type="button" data-dismiss="modal" id="mcb">&times;</button>
                  
                </div>
                <div class="modal-body" id="mbc">
                    <h4 id="mta">¡Felicidades!, tu evento ha sido creado con éxito</h4>
                    <br>
                    <h5>En breve recibirás un correo electrónico de confirmación. Mantente atento</h5>
                </div>
                <div class="modal-footer" id="mhc">
                
                </div>
            </div>
          </div>
      </div>

      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" id="mhc" align="right">
                      <button type="button" data-dismiss="modal" id="mcb">&times;</button>
                      <h4 class="modal-title" id="mta">¿No sabes como crear un evento?</h4>
                    </div>
                    <div class="modal-body" id="mbc">
                        <h4 id="mta">Sigue estos sencillos pasos</h4>
                        <center>
                          <ul class="list-inline">
                            <li>
                              <button id="buttonSpan"><span id="spanTuto" class="glyphicon glyphicon-log-in"></span><br>Inicia Sesiòn</button>
                              
                            </li>
                            <li>
                              <button id="buttonSpan"><span id="spanTuto" class="glyphicon glyphicon-search"></span><br>Explora Eventos</button>
                              
                            </li>
                            <li>
                              <button id="buttonSpan"><span id="spanTutoOp" class="glyphicon glyphicon-menu-hamburger"></span><br>Elige Opciones</button>
                              
                            </li>
                            <li>
                              <button id="buttonSpan"><span id="spanTutoPl" class="glyphicon glyphicon-plus"></span><br>Crea tu evento</button>
                              
                            </li>
                            <li>
                              <button id="buttonSpan"><span id="spanTuto" class="glyphicon glyphicon-list-alt"></span><br>Completa el formulario</button>
                              
                            </li>
                            <li>
                              <button id="buttonSpan"><span id="spanTuto" class="glyphicon glyphicon-envelope"></span><br>Espera la aprobación</button>
                              
                            </li>
                          </ul>
                        </center>
                          
                    </div>
                    <div class="modal-footer" id="mhc">
                    
                    </div>
                  </div>
        
        </div>
      </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    @if(session('success'))
              <script>
                $('#myModalEvento').modal('show');
              </script>
              @else
              <script>
                $('#myModal').modal('show');
              </script>
              
            @endif
    <script type="text/javascript">
      $('.botonF1').hover(function(){
        $('.btn').addClass('animacionVer');
      });
      $('.contenedor').mouseleave(function(){
        $('.btn').removeClass('animacionVer');
      });
      $('#search').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13')
          { //Enter keycode
            
            document.getElementById('searchEvento').submit();
         }
        
      });
      function myfunction()
      {
        if($('.animacionVer')[0])
        {
          $('.btn').removeClass('animacionVer');
        }
        else
        {
          $('.btn').addClass('animacionVer');

        }
        
      }
      $(document).ready(function(){
            $("#liBusqueda").hide();
        });
        function callinputSearch()
        {
            $("#liBusqueda").show();
            
        }
    </script>
    <script>
        /*window.onload = function() {
          
        };*/
        function tamanho(){
            if (screen.width<900) {
            $(".glyphicon-th-list").css("right","9px");
            $("#divImagen1").css("bottom","80px");
            $("#divImagen1").css("right","10px");
            }
            else {
              $(".botonF1").css("width","60px");
              $(".botonF1").css("height","60px");

            }
        }
          tamanho();
        </script>
    </body>
</html>
