<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Spart</title>
    <link rel="shortcut icon" href="img/favicon.png">
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendor/device-mockups/device-mockups.min.css">

    <!-- Theme CSS -->
    <link href="css/new-age.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <style>
    .jumbotron {
      background-color: #87B04A;
      color: #fff;
      height: 100%;
    }
    #logo
    {
        font-family: 'Roboto', sans-serif;
        color: #fff;
    }
    #text
    {
        font-size: 12pt;
    }
    #textdivision
    {
        background-color: #fff;
        border-color: #87B04A;
        color: #87B04A;
        padding-bottom: 7%;
        border: 2px solid;
        border-radius: 25px;
    }

    .btnspart {
        padding-left: 5%;
        background-color: #87B04A;
        color: #fff;
    }

    #botones
    {
        padding-top: 7%;
    }


    </style>

</head>

<body>
<div class="jumbotron text-center">
  <div class="col-sm-12">
      <div class="col-sm-4"></div>
      <div class="col-sm-4"  id="textdivision">
        <h1><b>spΔrt</b></h1> 
        <h2>¡Hola !</h2>
        <img src="{{$avatar}}" class="img img-circle" height="50" width="50">
        <p>{{$data}}</p>
        <p id="text">Para que disfrutes al 100% la experiencia de la plataforma necesitamos que registres un email válido.</p>
        <p id="text">De esta manera podremos darte una mejor atención, enviarte notificaciones de los eventos, avisarte cuando aprobemos tus eventos, mostrarte listas de grupos con los que puedes interactuar para participar de los eventos y algunas novedades que tengamos para ti.</p>
        <div id="botones">
        <form method="get" action="callregister">
            <button type="submit" class="btn btn-default btnspart">Registrar</button>    
        </form>
        <form method="get" action="/">
           <button type="submit" class="btn btn-default btnspart">Cancelar</button> 
        </form>
        </div>
      </div>
      <div class="col-sm-4"></div>

  </div>
  
</div>

</body>

</html>
