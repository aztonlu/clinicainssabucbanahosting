<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
@foreach ($odontogramas as $paciente)             
	<img src="{{ $paciente->imagen }}" id="imgC" name="imgC" >
	@foreach($detalles as $detalle)
		@if($paciente->idOdontograma == $detalle->idOdontograma)
		<p>{{ $detalle->concepto }} : {{ $detalle->precio }}</p>
		
		@else

		@endif
	@endforeach
@endforeach
                
</body>
</html>