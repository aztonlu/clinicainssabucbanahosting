<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
  <title></title>
  <style>
    body{ background-color: ivory; }
    canvas{
      border:1px solid red;
      background-image: url('{{ $odontogramas }}');
    }
    
  </style>
  <link rel="stylesheet" href="css/custom.css" >
  <link rel="stylesheet" href="css/bootstrap.min.css" >
</head>
<body>

@foreach ($pacientes as $paciente)
  @if($paciente->sexo == "Masculino")
    <ul class="list-inline">
      <li>
        <img src="img/boy.png">
      </li>
      <li>
        <h4>Paciente : </h4> <h4>{{ $paciente->nombres }} {{ $paciente->apPaterno }} {{ $paciente->apMaterno }}</h4>
      </li>
    </ul>
    
  @elseif($paciente->sexo == "Femenino")
    <ul class="list-inline">
      <li>
        <img src="img/girl.png">
      </li>
      <li>
        <h4>Paciente : </h4> <h4>{{ $paciente->nombres }} {{ $paciente->apPaterno }} {{ $paciente->apMaterno }}</h4>
      </li>
    </ul>
  @endif              
  
  @if($conceptos == "concepto_vacio")
    <form method="POST" action="insertarOdontograma" enctype="multipart/form-data" id="formulario">
      {{ csrf_field() }}
  @else
    <form method="POST" action="updateOdontograma" enctype="multipart/form-data" id="formulario">
      {{ csrf_field() }}
      <input type="hidden" name="idOdontograma" value="{{ $idOdontograma }}">
  @endif
      <div class="col-sm-12">
        <div class="col-sm-6">
          <canvas id="canvas" width=435 height=350></canvas><br>

          <button type="button" id="pen"></button>
          <button type="button" id="penRed"></button>
          <button type="button" id="penBlue"></button>
          <button type="button" id="penGreen"></button>
          <button type="button" id="eraser"></button>
          <button type="button" id="save" onclick="canvasToImg()"></button>
        </div>
        <div class="col-sm-6">
          <ul class="list-inline">
            <li>
              <h5>Concepto:</h5>
              <input type="text" name="concepto" id="concepto">
            </li>
            <li>
              <h5>Costo:</h5>
              <input type="number" name="costo" id="costo">
            </li>
            <li>
              <button type="button" class="btn btn-success" onclick="addConcepto()">+</button>
              @if($conceptos == "concepto_vacio")

              @else
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#example" >Ver Concepto</button>
              @endif
            </li>
          </ul>
          
            <table class="table" id="myTable">
              <thead>
                <tr>
                <th>ID</th>
                <th>Concepto</th>
                <th>Costo</th>
              </tr>
              </thead>
              <tbody id="cuerpoTabla">
                
              </tbody>
            </table>
            <ul class="list-inline">
              <li>
                <h5>Total de sesion:</h5>
              </li>
              <li>
                <input type="text" name="total" id="total" value="0">
              </li>
            </ul>
            <img src="" id="imgC" name="imgC" >
            <input type="hidden" name="image" value="{{ $odontogramas }}">
            <input type="hidden" name="texto64" id="texto64">
            <input type="hidden" name="dni" id="dni" class="total" value="{{ $paciente->dni }}">
            
            @if($conceptos == "concepto_vacio")
          @else
            @if(count($conceptos) == 0)
                <center><h5>No existen pagos previos</h5></center>
          @else    
            <table class="table" id="myTable">
            <thead>
              <tr>
              
              <th>Concepto</th>
              <th>precio</th>
            </tr>
            </thead>
            @foreach($conceptos as $concepto)
            <tbody>
              
                <td>{{ $concepto->concepto }}</td>
                <td>{{ $concepto->precio }}</td>
              

            </tbody>
            @endforeach
          </table>
              @endif
          @endif

        </div>
      </div>
      <div class="col-sm-6">
          <br><br><br><br><br><br>
          <ul class="list-inline">
            <li>
              <h5>Deuda:</h5>
              @if($deuda == "deuda_vacia")
                <input type="text" name="deuda" id="deuda">
              @else
                @if(count($deuda) > 0)
                  <input type="text" name="deuda" id="deuda" value="{{ $deuda }}">
                @else
                  <input type="text" name="deuda" id="deuda">
                @endif
              @endif
                
            </li>
            <li>
              <h5>Cuenta:</h5>
              <input type="number" name="cuenta" id="cuenta">
            </li>
            <li>
              <h5>fecha:</h5>
              <input type="text" name="fechaCuenta" id="fechaCuenta">
            </li>
            <li>
              <button type="button" class="btn btn-success" id="buttonCalculate" onclick="addDeuda()">+</button>
              @if($cuentas == "cuenta_vacio")
              @else
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#example1" >Ver Costos</button>
              @endif
            </li>
          </ul>    
          <!--<table class="table" id="tabla2">
            <thead>
              <tr>
                <th>Deuda</th>
                <th>Cuenta</th>
              </tr>
            </thead>
            <tbody id=¨tablabody¨>
              
            </tbody>
          </table>-->
          <ul class="list-inline">
            <li>
              <h5>Total Deuda:</h5>
            </li>
            <li>
              <input type="text" name="totaldeuda" id="totaldeuda" value="0">
            </li>
          </ul>        
          @if($cuentas == "cuenta_vacio")
          @else
            @if(count($cuentas) == 0)
                <center><h5>No existen pagos previos</h5></center>
          @else    
            <table class="table" id="myTable">
            <thead>
              <tr>
              <th>Fecha</th>
              <th>Dejo a Cuenta</th>
              <th>Deuda a la fecha</th>
              
            </tr>
            </thead>
            @foreach($cuentas as $cuenta)
            <tbody>
                <td>{{ $cuenta->fecha }}</td>
                <td>{{ $cuenta->cuenta }}</td>
                <td>{{ $cuenta->deuda }}</td>
                
                

            </tbody>
            @endforeach
          </table>
              @endif
          @endif
      </div>

  </form>
  <!-- Modal -->
  @extends('layouts.modalconceptos')
  @extends('layouts.modalcuentas')
@endforeach
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="http://malsup.github.com/jquery.form.js" /></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>

<script>
var canvas=document.getElementById("canvas");
var ctx=canvas.getContext("2d");


/*var outlineImage = new Image();

outlineImage.onload = function () {
  ctx.drawImage(outlineImage, 0, 0, outlineImage.width, outlineImage.height); // draw the image on the canvas
}
outlineImage.src = "img/odontograma.jpg";*/



var lastX;
var lastY;
var strokeColor="red";
var strokeWidth=5;
var mouseX;
var mouseY;
var canvasOffset=$("#canvas").offset();
var offsetX=canvasOffset.left;
var offsetY=canvasOffset.top;
var isMouseDown=false;


function handleMouseDown(e){
  mouseX=parseInt(e.clientX-offsetX);
  mouseY=parseInt(e.clientY-offsetY);

  // Put your mousedown stuff here
  lastX=mouseX;
  lastY=mouseY;
  isMouseDown=true;
}

function handleMouseUp(e){
  mouseX=parseInt(e.clientX-offsetX);
  mouseY=parseInt(e.clientY-offsetY);

  // Put your mouseup stuff here
  isMouseDown=false;
}

function handleMouseOut(e){
  mouseX=parseInt(e.clientX-offsetX);
  mouseY=parseInt(e.clientY-offsetY);

  // Put your mouseOut stuff here
  isMouseDown=false;
}
function handleMouseMove(e){
    mouseX=parseInt(e.clientX-offsetX);
    mouseY=parseInt(e.clientY-offsetY);

    // Put your mousemove stuff here
    if(isMouseDown){
      ctx.beginPath();
      if(mode=="pen"){
        ctx.globalCompositeOperation="source-over";
        ctx.moveTo(lastX,lastY);
        ctx.lineTo(mouseX,mouseY);
        ctx.strokeStyle= "#000";
        ctx.stroke();     
      }
      if(mode=="penRed"){
        ctx.globalCompositeOperation="source-over";
        ctx.moveTo(lastX,lastY);
        ctx.lineTo(mouseX,mouseY);
        ctx.strokeStyle= "#FF0000";
        ctx.stroke();     
      }
      if(mode=="penBlue"){
        ctx.globalCompositeOperation="source-over";
        ctx.moveTo(lastX,lastY);
        ctx.lineTo(mouseX,mouseY);
        ctx.strokeStyle= "#040CF4";
        ctx.stroke();     
      }
      if(mode=="penGreen"){
        ctx.globalCompositeOperation="source-over";
        ctx.moveTo(lastX,lastY);
        ctx.lineTo(mouseX,mouseY);
        ctx.strokeStyle= "#0FF62A";
        ctx.stroke();     
      }
      if(mode=="eraser"){

        ctx.globalCompositeOperation="destination-out";
        ctx.arc(lastX,lastY,8,0,Math.PI*2,false);
        ctx.fill();
      }
      lastX=mouseX;
      lastY=mouseY;
      }
}

$("#canvas").mousedown(function(e){handleMouseDown(e);});
$("#canvas").mousemove(function(e){handleMouseMove(e);});
$("#canvas").mouseup(function(e){handleMouseUp(e);});
$("#canvas").mouseout(function(e){handleMouseOut(e);});

var mode="pen";
$("#pen").click(function(){ mode="pen"; });
$("#penRed").click(function(){ mode="penRed"; });
$("#penBlue").click(function(){ mode="penBlue"; });
$("#penGreen").click(function(){ mode="penGreen"; });
$("#eraser").click(function(){ mode="eraser"; });

</script>
<script>
  function canvasToImg() {
      var canvas1 = document.getElementById("canvas");        
      if (canvas1.getContext) {
         var ctx = canvas1.getContext("2d");                
         var myImage = canvas1.toDataURL("image/png");      
      }
      var imageElement = document.getElementById("imgC");  
      imageElement.src = myImage;    
      var input64 = document.getElementById("texto64");
      input64.value = canvas1.toDataURL();
      guardar();


      
    }   
</script>
</body>
</html>