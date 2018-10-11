<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Historial;
use App\ExamenAuxiliar;
use App\Http\Requests;
use Auth;
use App\RecetaCabecera;
use App\Http\Requests\HistorialRequest;
use Illuminate\Support\Facades\Redirect;
use Image;
use DB;

class HistorialController extends Controller
{
    //

    public function formHistorial()
    {
      return view('formHistorial');
    }
    public function realizarHistorial(Request $request)
    {
      $dni = $request->dni;
      $paciente = Paciente::where('dni',$dni)->get();

      //Historial

      return view('formHistorial')->with('pacientes',$paciente);
    }
    public function registroHistorial(HistorialRequest $request)
    {
      $status = $request->status;
      $dni = $request->dni;
      $count = $request->count;

      if($status == "receta")
      {
        $diagnostico = $request->diagnostico;
        $historial = new Historial;
        $historial->fechaHistorial = $request->fechaHistorial;
        $historial->dni = $request->dni;
        $historial->tiempoEnfermedad = $request->tiempoEnfermedad;
        $historial->formaInicio = $request->formaInicio;
        $historial->curso = $request->curso;
        $historial->signos = $request->signos;
        $historial->relato = $request->relato;
        $historial->examenFisico = $request->examenfisico;
        $historial->diagnostico = $request->diagnostico;
        $historial->tratamiento = $request->tratamiento;
        $historial->estado = "guardado";
        $historial->save();

        $paciente = Paciente::where('dni',$dni)->get();
        $idUser = Auth::user()->id;
        //receta


        $nombreMedicamento = $request->input('titulo');
        if($nombreMedicamento == "")
        {

        }
        else {
          $idHistorial = Historial::where('dni',$dni)->orderBy('idHistorial', 'desc')->value('idHistorial');
          $file = $request->file('imagen');
          $random = str_random(5).$file->getClientOriginalName();
          $nombre = 'examenes/'.Auth::user()->id.$random;
          $image = Image::make($file->getRealPath())->resize(150, 150);
          $image->save($nombre);
          $examen = new ExamenAuxiliar;
          $examen->nombreExamen = $nombreMedicamento;
          $examen->rutaImagen = $nombre;
          $examen->idHistorial = $idHistorial;
          $examen->save();
        }


        $idHistorial = Historial::where('dni',$dni)->orderBy('idHistorial', 'desc')->value('idHistorial');
        for($i=0;$i<$count;$i++)
        {

          $idExamenAuxiliar = $request->input('idExamenAuxiliar'.$i);
          ExamenAuxiliar::where('idExamenAuxiliar', $idExamenAuxiliar)->update(['idHistorial' => $idHistorial]);

        }
        return view('formReceta')->with('pacientes',$paciente)->with('diagnostico',$diagnostico)->with('idHistorial',$idHistorial);
      }
      elseif ($status == "noreceta") {
        $diagnostico = $request->diagnostico;
        $historial = new Historial;
        $historial->fechaHistorial = $request->fechaHistorial;
        $historial->dni = $request->dni;
        $historial->tiempoEnfermedad = $request->tiempoEnfermedad;
        $historial->formaInicio = $request->formaInicio;
        $historial->curso = $request->curso;
        $historial->signos = $request->signos;
        $historial->relato = $request->relato;
        $historial->examenFisico = $request->examenfisico;
        $historial->diagnostico = $request->diagnostico;
        $historial->tratamiento = $request->tratamiento;
        $historial->estado = "guardado";
        $historial->save();
        $idHistorial = Historial::where('dni',$dni)->orderBy('idHistorial', 'desc')->value('idHistorial');
        for($i=0;$i<$count;$i++)
        {

          $idExamenAuxiliar = $request->input('idExamenAuxiliar'.$i);
          ExamenAuxiliar::where('idExamenAuxiliar', $idExamenAuxiliar)->update(['idHistorial' => $idHistorial]);

        }

        $nombreMedicamento = $request->input('titulo');
        if($nombreMedicamento == "")
        {

        }
        else {
          $idHistorial = Historial::where('dni',$dni)->orderBy('idHistorial', 'desc')->value('idHistorial');
          $file = $request->file('imagen');
          $random = str_random(5).$file->getClientOriginalName();
          $nombre = 'examenes/'.Auth::user()->id.$random;
          $image = Image::make($file->getRealPath())->resize(150, 150);
          $image->save($nombre);
          $examen = new ExamenAuxiliar;
          $examen->nombreExamen = $nombreMedicamento;
          $examen->rutaImagen = $nombre;
          $examen->idHistorial = $idHistorial;
          $examen->save();
        }

        return Redirect::action('HomeController@indexHistorial')->with('success','¡Felicitaciones!,La transaccion  ha sido hecha con éxito');
      }
    }

    public function insertarExamen(Request $request)
    {

      $nombreMedicamento = $request->input('tituloE');
      $file = $request->file('imagen');
      $random = str_random(5).$file->getClientOriginalName();
      $nombre = 'examenes/'.Auth::user()->id.$random;
      $image = Image::make($file->getRealPath())->resize(150, 150);
      $image->save($nombre);
      $examen = new ExamenAuxiliar;
      $examen->nombreExamen = $nombreMedicamento;
      $examen->rutaImagen = $nombre;
      $examen->idHistorial = -1;
      $examen->save();

      $examenAuxiliar = ExamenAuxiliar::where('idHistorial',-1)->get();
      if($examenAuxiliar)
      {
        $valor = "";
        for($i = 0; $i < count($examenAuxiliar); $i++)
        {
          $valor = $valor.'<tr>'.'<td><img src="'.$examenAuxiliar[$i]->rutaImagen.'" width="30" height="30"></td>'.'<td>'.$examenAuxiliar[$i]->nombreExamen.'</td>'.'<td>'.'<button type="button" onclick="eliminarExamen('.$examenAuxiliar[$i]->idExamenAuxiliar.')" class="btn btn-info""><i class="glyphicon glyphicon-trash" align="right""></i></button><input type="hidden" name="idExamenAuxiliar'.$i.'" id=idExamenAuxiliar'.$i.'" value="'.$examenAuxiliar[$i]->idExamenAuxiliar.'"></td></tr>';
        }
        $output = $valor;
        return Response($output);
      }
    }
    public function modificarHistorial(Request $request)
    {
      $idHistorial = $request->idHistorial;
      $historiales = DB::table('pacientes')
                ->join('historials', 'pacientes.dni', '=', 'historials.dni')
                ->select('pacientes.*', 'historials.*')->where('historials.idHistorial',$idHistorial)
                ->get();
      $examenAuxiliar = DB::table('historials')
                        ->join('examen_auxiliars','historials.idHistorial','=','examen_auxiliars.idHistorial')
                        ->select('examen_auxiliars.*')->where('examen_auxiliars.idHistorial',$idHistorial)
                        ->get();
      return view('modificarHistorial')->with('historiales',$historiales)->with('examenes',$examenAuxiliar);
    }
    public function modificarHistorialForm(HistorialRequest $request)
    {

    }
    public function eliminarExamen(Request $request)
    {
      $output ="";
      $idHistorial = $request->idHistorial;
      $idExamenAuxiliar = $request->idExamenAuxiliar;
      $ruta = ExamenAuxiliar::where('idExamenAuxiliar', $idExamenAuxiliar)->value('rutaImagen');
      $deletedRows = ExamenAuxiliar::where('idExamenAuxiliar', $idExamenAuxiliar)->delete();

      unlink($ruta);
      
        $examenAuxiliar = ExamenAuxiliar::where('idHistorial',-1)->get();


      if($examenAuxiliar)
      {
        $valor = "";
        for($i = 0; $i < count($examenAuxiliar); $i++)
        {
          $valor = $valor.'<tr>'.'<td><img src="'.$examenAuxiliar[$i]->rutaImagen.'" width="30" height="30" name="imagen'.$i.'" id="imagen'.$i.'"></td>'.'<td>'.$examenAuxiliar[$i]->nombreExamen.'<input type="hidden" name="examen'.$i.'" id="examen'.$i.'"></td>'.'<td>'.'<button type="button" onclick="eliminarExamen('.$examenAuxiliar[$i]->idExamenAuxiliar.')" class="btn btn-info")"><i class="glyphicon glyphicon-trash" align="right""></i></button></td>'.'</tr>';
        }
        $output = $valor;
        return Response($output);
      }
    }
    public function insertarExamenFormulario(Request $request)
    {
      $idHistorial = $request->idHistorial;
      $nombreMedicamento = $request->input('tituloE');
      $file = $request->file('imagen');
      $random = str_random(5).$file->getClientOriginalName();
      $nombre = 'examenes/'.Auth::user()->id.$random;
      $image = Image::make($file->getRealPath())->resize(150, 150);
      $image->save($nombre);
      $examen = new ExamenAuxiliar;
      $examen->nombreExamen = $nombreMedicamento;
      $examen->rutaImagen = $nombre;
      $examen->idHistorial = $idHistorial;
      $examen->save();
      $examenAuxiliar = ExamenAuxiliar::where('idHistorial',$request->idHistorial)->get();
      if($examenAuxiliar)
      {
        $valor = "";
        for($i = 0; $i < count($examenAuxiliar); $i++)
        {
          $valor = $valor.'<tr>'.'<td><img src="'.$examenAuxiliar[$i]->rutaImagen.'" width="30" height="30" name="imagen'.$i.'" id="imagen'.$i.'"></td>'.'<td>'.$examenAuxiliar[$i]->nombreExamen.'<input type="hidden" name="examen'.$i.'" id="examen'.$i.'"></td>'.'<td>'.'<button type="button" class="btn btn-info")"><i class="glyphicon glyphicon-trash" align="right""></i></button></td>'.'</tr>';
        }
        $output = $valor;
        return Response($output);
      }

    }

}
