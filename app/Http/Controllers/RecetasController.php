<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecetaCabecera;
use App\RecetaCuerpo;
use App\Paciente;
use App\User;
use Session;
use DB;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

class RecetasController extends Controller
{
    //

    public function realizarReceta(Request $request)
    {
      $dni = $request->dni;
      $paciente = Paciente::where('idPaciente',$dni)->get();

      return view('formReceta')->with('pacientes',$paciente);

    }
    public function saveItemOdontograma(Request $request)
    {
      
      Cache::add('conceptos',[$request->concepto,$request->precio],5);
    }
    public function saveItemReceta(Request $request)
    {
      $output ="";
      if ($request->ajax())
      {
          $cuerpo = new RecetaCuerpo;
          $cuerpo->idReceta = $request->idReceta;
          $cuerpo->nombreMedicamento = $request->nombreMedicamento;
          $cuerpo->dosis = $request->dosis;
          $cuerpo->via = $request->via;
          $cuerpo->frecuencia = $request->frecuencia;
          $cuerpo->duracion = $request->duracion;
          $cuerpo->save();
          $recetas = RecetaCuerpo::where('idReceta',$request->idReceta)->get();

          if($recetas)
          {
            $valor = "";
            for($i = 0; $i < count($recetas); $i++)
            {

              $valor = $valor.'<tr>'.'<td>'.$recetas[$i]->nombreMedicamento.'</td>'.'<td>'.$recetas[$i]->dosis.'</td>'.'<td>'.$recetas[$i]->via.'</td>'.'<td>'.$recetas[$i]->frecuencia.'</td>'.'<td>'.$recetas[$i]->duracion.'</td>'.'<td>'.'<button type="button" class="btn btn-info" onclick="confirmar1('.$recetas[$i]->idRecetaCuerpo.')"><i class="glyphicon glyphicon-trash" align="right""></i></button><input type="hidden" id="idRecetaCuerpo'.$i.'" name="idRecetaCuerpo'.$i.'" value="'.$recetas[$i]->idRecetaCuerpo.'"></td>'.'</tr>';
            }
            $output = $valor;
            return Response($output);
          }


      }
    }
    public function eliminarRecetaCuerpo(Request $request)
    {
      $output ="";
      if ($request->ajax())
      {
        $deletedRows = RecetaCuerpo::where('idRecetaCuerpo', $request->idRecetaCuerpo)->delete();
          $recetas = RecetaCuerpo::where('idReceta',-1)->get();

          if($recetas)
          {
            $valor = "";
            for($i = 0; $i < count($recetas); $i++)
            {

              $valor = $valor.'<tr>'.'<td>'.$recetas[$i]->nombreMedicamento.'</td>'.'<td>'.$recetas[$i]->dosis.'</td>'.'<td>'.$recetas[$i]->via.'</td>'.'<td>'.$recetas[$i]->frecuencia.'</td>'.'<td>'.$recetas[$i]->duracion.'</td>'.'<td>'.'<button type="button" class="btn btn-info" onclick="confirmar1('.$recetas[$i]->idRecetaCuerpo.')"><i class="glyphicon glyphicon-trash" align="right""></i></button><input type="hidden" id="idRecetaCuerpo'.$i.'" name="idRecetaCuerpo'.$i.'" value="'.$recetas[$i]->idRecetaCuerpo.'"></td>'.'</tr>';
            }
            $output = $valor;
            return Response($output);
          }


      }
    }
    public function updateReceta(Request $request)
    {
      $count = $request->count;
      $idHistorial = $request->idHistorial;
      $dni = $request->dni;
      $idUser = Auth::user()->id;
      $cabeza = new RecetaCabecera;
      $cabeza->idPaciente = $dni;
      $cabeza->fechaReceta = $request->fechaReceta;
      $cabeza->idUser = $idUser;
      $cabeza->diagnostico = $request->diagnostico;
      $cabeza->estado = "guardado";
      $cabeza->save();
      $idReceta = RecetaCabecera::where('idPaciente',$dni)->where('idUser',Auth::user()->id)->orderBy('idReceta', 'desc')->value('idReceta');

      RecetaCabecera::where('idReceta', $idReceta)->update(['idHistorial' => $idHistorial]);
      for($i=0;$i<$count;$i++)
      {

        $idRecetaCuerpo = $request->input('idRecetaCuerpo'.$i);
        RecetaCuerpo::where('idRecetaCuerpo', $idRecetaCuerpo)->update(['idReceta' => $idReceta]);

      }

      return Redirect::action('HomeController@recetas')->with('success','¡Felicitaciones!,La transaccion  ha sido hecha con éxito');
    }
    public function modificarReceta(Request $request)
    {
      $idReceta = $request->idReceta;
      $cabecera = DB::table('pacientes')
            ->join('receta_cabeceras', 'pacientes.dni', '=', 'receta_cabeceras.idPaciente')
            ->select('pacientes.*', 'receta_cabeceras.*')->where('receta_cabeceras.idReceta',$idReceta)
            ->get();
      $cuerpo = RecetaCuerpo::where('idReceta',$idReceta)->get();
      return view('modificaReceta')->with('cabeceras',$cabecera)->with('cuerpos',$cuerpo);
    }
}
