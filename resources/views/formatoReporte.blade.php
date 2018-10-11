<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Médico</title>
<style>

 .col-md-12 {
    width: 100%;
}

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    background-color: #ECF0F5;
}

.box-header {
    color: #000;
    display: block;
    padding: 10px;
    position: relative;
}

.box-header.with-border {
    border-bottom: 1px solid #000;
}


.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;

}


.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}


.table-bordered {
    border: 1px solid #f4f4f4;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}



 .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #f4f4f4;
}


.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
}

.bg-red {
    background-color: #dd4b39 !important;
}


</style>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>

<div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <img src="img/logo.png" width="160" height="60">
                  <h3 class="box-title">Reporte Médico</h3>
                  <br>
                  <h4 class="box-title">Clínica de Salud</h4>
                  <h4 class="box-title">...............</h4>
                </div>
                <div class="box-body">
                  <table class="table table-bordered" style="">
                    <tbody>
                    <tr>
                      <td><b>DATOS GENERALES</b></td>
                    </tr>
                    <?php foreach ($pacientes as $paciente) {?>
                    <tr>
                        <td><h5><b>Nombre Completo:</b><h5></td>
                        <td style="padding-left: 0px">{{ $paciente->apPaterno}} {{ $paciente->apMaterno }} {{ $paciente->nombres}}</td>
                    </tr>
                    <tr>
                      <td style="padding-top: -40px;"><h5><b>Sexo:</b></h5></td>
                      <td style="padding-top: -40px; padding-left: 0px">{{ $paciente->sexo}}</td>
                    </tr>
                    <tr>
                      <td style="padding-top: -40px;"><h5><b>Teléfono:</b></h5></td>
                      <td style="padding-top: -40px; padding-left: 0px">{{ $paciente->telefono}}</td>
                    </tr>
                    <tr>
                      <td style="padding-top: -40px"><h5><b>Edad:</b></h5></td>
                      <td style="padding-top: -40px; padding-left: 0px">{{ $paciente->edad}}</td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td><b>HISTORIALES MÉDICOS</b></td>
                    </tr>
                    <?php foreach ($historiales as $historial) {?>
                      <tr>
                          <td><h5><b>Fecha Historial:</b><h5></td>
                          <td style="padding-button: 0px">{{ $historial->fechaHistorial}}</td>
                      </tr>
                      <tr>
                        <td style=""><h5><b>Tiempo de la Enfermedad:</b></h5></td>
                        <td style="white-space:pre-wrap; max-width: 300px"><div>{{$historial->tiempoEnfermedad}}</div></td>
                      </tr>
                      <tr>
                        <td style=""><h5><b>Forma de Inicio:</b></h5></td>
                        <td style="">{{$historial->formaInicio}}</td>
                      </tr>
                      <tr>
                        <td style="padding-top: -40px;"><h5><b>Curso:</b></h5></td>
                        <td style="padding-top: -40px;">{{$historial->curso}}</td>
                      </tr>
                    <?php } ?>
                  </tbody>

                  </table>

                </div><!-- /.box-body -->

                <div class="box-footer clearfix">

                </div>
              </div><!-- /.box -->
							<table style="background-color: #000; color: #fff; width: 400px; margin-rigth: 250px;">
								<tbody>
									<?php foreach ($historiales as $historial) {?>
										<tr>
											<td><h3><b>Tiempo de la Enfermedad:</b></h3></td>
											<td style="margin-rigth: 100px; padding-rigth: 200px;"><h5>{{$historial->tiempoEnfermedad}}</h5></td>
										</tr>
										<?php } ?>
								</tbody>
							</table>

            </div>



</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
