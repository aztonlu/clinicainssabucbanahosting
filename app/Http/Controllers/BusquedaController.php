<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Cuenta;
use App\Odontograma;
use App\DetalleOdontograma;
use App\Http\Requests;
use DB;
use Auth;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;


class BusquedaController extends Controller
{
    //
    public function searchPaciente(Request $request)
    {
      $output ="";
      $status = $request->status;
      if ($request->ajax())
      {
          
        
            if($status == "dni")
            {
              $pacientes = Paciente::where('dni','LIKE','%'.$request->search.'%')->get();
            }
            else {
              $pacientes = Paciente::where('apPaterno','LIKE','%'.$request->search.'%')->get();
            }

          

          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++) {
                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->telefono.'</td>'.
                                   '<td>
                                   <form action="modificarPacienteBuscado" method="get">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right""></i></button>
                                    </form>
                                   </td>'.
                                   '<td>
                                   <form action="realizarCita" method="get">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right""></i></button>
                                    </form>
                                   </td>'.
                                   '<td>

                                    <form action="realizarHistorial" method="GET">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right"></i></button>
                                    </form>
                                   </td>'.
                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function searchPacienteodontograma(Request $request)
    {
      $output ="";
      $status = $request->status;
      if ($request->ajax())
      {
          
        
            if($status == "dni")
            {
              $pacientes = Paciente::where('dni','LIKE','%'.$request->search.'%')->get();
            }
            else {
              $pacientes = Paciente::where('apPaterno','LIKE','%'.$request->search.'%')->get();
            }


          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++) {
                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->telefono.'</td>'.
                                   '<td>
                                   <form action="prueba" method="get">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right""></i></button>
                                    </form>
                                   </td>'.
                                   '<td>
                                   <form action="nuevoOdontograma" method="get">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-plus" align="right""></i></button>
                                    </form>
                                   </td>'.
                                   '<td>
                                   <form action="mostrarReporte" method="get">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-file" align="right""></i></button>
                                    </form>
                                   </td>'.
                                   '<td>

                                   </td>'.
                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function searchPacienteSecretario(Request $request)
    {
      $output ="";
      $status = $request->status;

      if ($request->ajax())
      {

            if($status == "dni")
            {
              $pacientes = Paciente::where('dni','LIKE','%'.$request->search.'%')->get();
            }
            else {
              $pacientes = Paciente::where('apPaterno','LIKE','%'.$request->search.'%')->get();
            }



          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++) {
                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->telefono.'</td>'.
                                   '<td>
                                   <form action="modificarPacienteBuscadoSecretario" method="get">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right""></i></button>
                                    </form>
                                   </td>'.
                                   '<td>
                                   <form action="realizarCitaSecretario" method="get">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right""></i></button>
                                    </form>
                                   </td>'.

                              '</tr>';
              }
              $output = $valor;
              return Response($output);
            }
      }
    }
    public function searchPacienteCita(Request $request)
    {
      $output ="";
      $status = $request->status;
      if ($request->ajax())
      {
        if($status == "dni")
        {
          $pacientes = Paciente::where('dni','LIKE','%'.$request->search.'%')->get();
        }
        else {
          $pacientes = Paciente::where('apPaterno','LIKE','%'.$request->search.'%')->get();
        }
          if($pacientes)
          {
              foreach ($pacientes as $key => $paciente) {
                  $output = '<tr>'.'<td>'.$paciente->dni.'</td>'.
                                  '<td>'.$paciente->nombres.'</td>'.
                                  '<td>'.$paciente->apPaterno.'</td>'.
                                  '<td>'.$paciente->apMaterno.'</td>'.

                                   '<td>
                                     <form action="realizarCita" method="GET">
                                       <input type="hidden" name="dni" id="dni" value="'. $paciente->dni.'">
                                       <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                     </form>
                                   </td>'.
                              '</tr>';
              }
              return Response($output);
          }
      }
    }
    public function searchPacienteReceta(Request $request)
    {
      $output ="";
      if ($request->ajax())
      {

          $pacientes = Paciente::where('apPaterno','LIKE','%'.$request->search.'%')->get();
          if($pacientes)
          {
              foreach ($pacientes as $key => $paciente) {
                  $output = '<tr>'.'<td>'.$paciente->dni.'</td>'.
                                  '<td>'.$paciente->nombres.'</td>'.
                                  '<td>'.$paciente->apPaterno.'</td>'.
                                  '<td>'.$paciente->apMaterno.'</td>'.
                                   '<td>
                                   <form action="realizarReceta" method="get">
                                      <input type="hidden" name="dni" id="dni" value="'.$paciente->idPaciente.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right""></i></button>
                                    </form>
                                   </td>'.
                              '</tr>';
              }
              return Response($output);
          }
      }
    }
    public function searchCitasSecretario(Request $request)
    {
      $output ="";
      $status = $request->status;

      if ($request->ajax())
      {

            if($status == "dni")
            {
              $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('pacientes.dni','LIKE','%'.$request->search.'%')
                    ->get();
            }
            else {
              $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('pacientes.apPaterno','LIKE','%'.$request->search.'%')
                    ->get();
            }


          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++){
                  if($pacientes[$i]->estado == "Atendido")
                  {
                    $porcionTD = '<td class="success"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }
                  if($pacientes[$i]->estado == "Por Atender") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }elseif($pacientes[$i]->estado == "Faltante") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }

                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->fechaCita.'</td>'.
                                   '<td>
                                    <form action="modificarCitaSecretario" method="GET">
                                      <input type="hidden" name="idCita" id="idCita" value="'.$pacientes[$i]->idCita.'"">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   $porcionTD.

                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function getCitasMañana(Request $request)
    {
      $output ="";
      if ($request->ajax())
      {
        $carbon = new \Carbon\Carbon();
        $dt= $carbon::now();
        $ma = $dt->addDay();
        $hoy =$ma->toDateString();
           
         $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('citas.fechaCita',$hoy)
                    ->get();
          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++){
                  if($pacientes[$i]->estado == "Atendido")
                  {
                    $porcionTD = '<td class="success"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }
                  if($pacientes[$i]->estado == "Por Atender") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }elseif($pacientes[$i]->estado == "Faltante") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }

                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->lugar.'</td>'.
                                  '<td>'.$pacientes[$i]->fechaCita.'</td>'.
                                   '<td>
                                    <form action="modificarCita" method="GET">
                                      <input type="hidden" name="idCita" id="idCita" value="'.$pacientes[$i]->idCita.'"">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   $porcionTD.

                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function getCitasHoySecretario(Request $request)
    {
      $output ="";
      $fecha = $request->fecha;
      if ($request->ajax())
      {
        
        $hoy =$fecha;
           
         $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('citas.fechaCita',$hoy)->where('citas.lugar',Auth::user()->lugar)
                    ->get();
          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++){
                  if($pacientes[$i]->estado == "Atendido")
                  {
                    $porcionTD = '<td class="success"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }
                  if($pacientes[$i]->estado == "Por Atender") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }elseif($pacientes[$i]->estado == "Faltante") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }

                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->lugar.'</td>'.
                                  '<td>'.$pacientes[$i]->fechaCita.'</td>'.
                                   '<td>
                                    <form action="modificarCita" method="GET">
                                      <input type="hidden" name="idCita" id="idCita" value="'.$pacientes[$i]->idCita.'"">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   $porcionTD.

                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function getCitasMañanaSecretario(Request $request)
    {
      $output ="";
      if ($request->ajax())
      {
        $carbon = new \Carbon\Carbon();
        $dt= $carbon::now();
        $ma = $dt->addDay();
        $hoy =$ma->toDateString();
           
         $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('citas.fechaCita',$hoy)->where('citas.lugar',Auth::user()->lugar)
                    ->get();
          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++){
                  if($pacientes[$i]->estado == "Atendido")
                  {
                    $porcionTD = '<td class="success"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }
                  if($pacientes[$i]->estado == "Por Atender") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }elseif($pacientes[$i]->estado == "Faltante") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }

                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->lugar.'</td>'.
                                  '<td>'.$pacientes[$i]->fechaCita.'</td>'.
                                   '<td>
                                    <form action="modificarCita" method="GET">
                                      <input type="hidden" name="idCita" id="idCita" value="'.$pacientes[$i]->idCita.'"">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   $porcionTD.

                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function getCitasSemanaSecretario(Request $request)
    {
      $output ="";
      if ($request->ajax())
      {
        $carbon = new \Carbon\Carbon();
        $dt= $carbon::now();
        $hoy =$dt->toDateString();
        $semana = $dt->addWeek();
        
        $semana1 =$semana->toDateString();
           
         $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->whereBetween('citas.fechaCita',[$hoy,$semana1])->where('citas.lugar',Auth::user()->lugar)->orderBy('citas.fechaCita', 'asc')
                    ->get();
          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++){
                  if($pacientes[$i]->estado == "Atendido")
                  {
                    $porcionTD = '<td class="success"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }
                  if($pacientes[$i]->estado == "Por Atender") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }elseif($pacientes[$i]->estado == "Faltante") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }

                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->lugar.'</td>'.
                                  '<td>'.$pacientes[$i]->fechaCita.'</td>'.
                                   '<td>
                                    <form action="modificarCita" method="GET">
                                      <input type="hidden" name="idCita" id="idCita" value="'.$pacientes[$i]->idCita.'"">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   $porcionTD.

                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function getCitasSemana(Request $request)
    {
      $output ="";
      if ($request->ajax())
      {
        $carbon = new \Carbon\Carbon();
        $dt= $carbon::now();
        $hoy =$dt->toDateString();
        $semana = $dt->addWeek();
        
        $semana1 =$semana->toDateString();
           
         $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->whereBetween('citas.fechaCita',[$hoy,$semana1])->orderBy('citas.fechaCita', 'asc')
                    ->get();
          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++){
                  if($pacientes[$i]->estado == "Atendido")
                  {
                    $porcionTD = '<td class="success"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }
                  if($pacientes[$i]->estado == "Por Atender") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }elseif($pacientes[$i]->estado == "Faltante") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }

                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->lugar.'</td>'.
                                  '<td>'.$pacientes[$i]->fechaCita.'</td>'.
                                   '<td>
                                    <form action="modificarCita" method="GET">
                                      <input type="hidden" name="idCita" id="idCita" value="'.$pacientes[$i]->idCita.'"">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   $porcionTD.

                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function getCitasHoy(Request $request)
    {
      $output ="";
      $fecha = $request->fecha;
      if ($request->ajax())
      {
        //$carbon = new \Carbon\Carbon();
        //$dt= $carbon::now();
        $hoy =$fecha;
           
         $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('citas.fechaCita',$hoy)
                    ->get();
          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++){
                  if($pacientes[$i]->estado == "Atendido")
                  {
                    $porcionTD = '<td class="success"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }
                  if($pacientes[$i]->estado == "Por Atender") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }elseif($pacientes[$i]->estado == "Faltante") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }

                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->lugar.'</td>'.
                                  '<td>'.$pacientes[$i]->fechaCita.'</td>'.
                                   '<td>
                                    <form action="modificarCita" method="GET">
                                      <input type="hidden" name="idCita" id="idCita" value="'.$pacientes[$i]->idCita.'"">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   '<td>

                                    <form action="realizarHistorial" method="GET">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   $porcionTD.
                                   '<td>
                                  <form action="mostrarReporte" method="GET">
                                    <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'"">
                                    <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list" align="right"></i></button>
                                  </form>
                                 </td>'.
                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function searchCitas(Request $request)
    {
      $output ="";
      $status = $request->status;

      if ($request->ajax())
      {

            if($status == "dni")
            {
              $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('pacientes.dni','LIKE','%'.$request->search.'%')
                    ->get();
            }
            else {
              $pacientes = DB::table('pacientes')
                    ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
                    ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('pacientes.apPaterno','LIKE','%'.$request->search.'%')
                    ->get();
            }


          if($pacientes)
          {
              $valor = "";
              for($i=0; $i< count($pacientes); $i++){
                  if($pacientes[$i]->estado == "Atendido")
                  {
                    $porcionTD = '<td class="success"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" class="btn btn-info"><i class="glyphicon glyphicon-ok" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }
                  if($pacientes[$i]->estado == "Por Atender") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }elseif($pacientes[$i]->estado == "Faltante") {
                    $porcionTD = '<td class="danger"><center><button type="button" style="background-color:transparent;color:#000;border-color:#000" onclick="confirmar()" class="btn btn-info"><i class="glyphicon glyphicon-remove" align="right" ></i></button>'.$pacientes[$i]->estado.'</center></td>';
                  }

                  $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                  '<td>'.$pacientes[$i]->nombres.'</td>'.
                                  '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                  '<td>'.$pacientes[$i]->lugar.'</td>'.
                                  '<td>'.$pacientes[$i]->fechaCita.'</td>'.
                                   '<td>
                                    <form action="modificarCita" method="GET">
                                      <input type="hidden" name="idCita" id="idCita" value="'.$pacientes[$i]->idCita.'"">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                    </form>
                                   </td>'.

                                   '<td>

                                    <form action="realizarHistorial" method="GET">
                                      <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'">
                                      <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list-alt" align="right"></i></button>
                                    </form>
                                   </td>'.
                                   $porcionTD.
                                   '<td>
                                  <form action="mostrarReporte" method="GET">
                                    <input type="hidden" name="dni" id="dni" value="'.$pacientes[$i]->dni.'"">
                                    <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-list" align="right"></i></button>
                                  </form>
                                 </td>'.
                              '</tr>';
              }
              $output = $valor;
              return Response($output);
          }
      }
    }
    public function odontograma()
    {
      $pacientes = Paciente::paginate(10);
      return view('odontograma', ['pacientes' => $pacientes]);
      
    }
    public function prueba(Request $request)
    {
      $odontograma = Odontograma::where('dni',$request->dni)->orderBy('idOdontograma','DESC')->value('imagen');
      $id = Odontograma::where('dni',$request->dni)->orderBy('idOdontograma','DESC')->value('idOdontograma');
      $conceptos = DetalleOdontograma::where('idOdontograma',$id)->get();
      $cuentas = Cuenta::where('idOdontograma',$id)->get();
      $deuda = Cuenta::where('idOdontograma',$id)->orderBy('id','DESC')->value('deuda');
      if(is_null($odontograma))
      {
        $odontograma = 'img/odontograma.jpg';
      }
      $dni = Paciente::where('dni',$request->dni)->get();
      return view('html5')->with('pacientes',$dni)->with('odontogramas',$odontograma)->with('conceptos',$conceptos)->with('idOdontograma',$id)->with('cuentas',$cuentas)->with('deuda',$deuda);
      
    }
    public function nuevoOdontograma(Request $request)
    {
      $odontograma = 'img/odontograma.jpg';
      $id = Odontograma::where('dni',$request->dni)->orderBy('idOdontograma','DESC')->value('idOdontograma');
      //$conceptos = DetalleOdontograma::where('idOdontograma',$id)->get();
      
      $dni = Paciente::where('dni',$request->dni)->get();
      return view('html5')->with('pacientes',$dni)->with('odontogramas',$odontograma)->with('conceptos',"concepto_vacio")->with('cuentas',"cuenta_vacio")->with('deuda',"deuda_vacia");;
    }
    public function updateOdontograma(Request $request)
    {
       $fondo = 'img/odontograma.jpg';
      $img = $request->file('imgC');
      $texto = $request->texto64;
      $imagen = $request->image;

      $random = str_random(5);
      $nombre = 'examenes/'.$random.'.png';
      $image = Image::make($imagen)->resize(435, 350);
      $image->insert($texto,'top-left');
      
      $image->save($nombre);
      /*$examen = new Odontograma;
      $examen->imagen = $nombre;
      $examen->dni = $request->dni;
      $examen->save();*/
      Odontograma::where('idOdontograma', $request->idOdontograma)->update(['imagen' => $nombre]);

      
      $id = $request->idOdontograma;
      $countConcepto = count($request->concepto);
      $concepto = $request->concepto;
      $precio = $request->precio;

      for ($i=0; $i < $countConcepto ; $i++) { 
          $detalle = new DetalleOdontograma;
          $detalle->concepto = $concepto[$i];
          $detalle->precio = $precio[$i];
          $detalle->idOdontograma = $id;
          $detalle->dni = $request->dni;
          $detalle->save();
      }

      //guardar costos aqui
      $deuda = $request->deuda;
      $cuenta = $request->cuenta;
      $totalcuenta = $deuda - $cuenta;
      
      
      $detalle = new Cuenta;
      $detalle->deuda = $totalcuenta;
      $detalle->cuenta = $cuenta;
      $detalle->idOdontograma = $id;
      $detalle->fecha = $request->fechaCuenta;
      //$detalle->dni = $request->dni;
      $detalle->save();
      
      return Redirect::action('BusquedaController@odontograma');
    }
    public function insertarOdontograma(Request $request)
    {
      $fondo = 'img/odontograma.jpg';
      $img = $request->file('imgC');
      $texto = $request->texto64;
      $imagen = $request->image;

      $random = str_random(5);
      $nombre = 'examenes/'.$random.'.png';
      $image = Image::make($imagen)->resize(435, 350);
      $image->insert($texto,'top-left');
      
      $image->save($nombre);
      $examen = new Odontograma;
      $examen->imagen = $nombre;
      $examen->dni = $request->dni;
      $examen->save();

      
      $id = Odontograma::latest()->value('idOdontograma');
      $countConcepto = count($request->concepto);
      $concepto = $request->concepto;
      $precio = $request->precio;

      for ($i=0; $i < $countConcepto ; $i++) { 
          $detalle = new DetalleOdontograma;
          $detalle->concepto = $concepto[$i];
          $detalle->precio = $precio[$i];
          $detalle->idOdontograma = $id;
          $detalle->dni = $request->dni;
          $detalle->save();
      }

      //guardar costos aqui
      
      $deuda = $request->deuda;
      $cuenta = $request->cuenta;
      $totalcuenta = $deuda - $cuenta;
      
      
      $detalle = new Cuenta;
      $detalle->deuda = $totalcuenta;
      $detalle->cuenta = $cuenta;
      $detalle->idOdontograma = $id;
      $detalle->fecha = $request->fechaCuenta;
      //$detalle->dni = $request->dni;
      $detalle->save();
      
      
      return Redirect::action('BusquedaController@odontograma');
    }
    public function detalleOdontograma(Request $request)
    {
      
      
      $odon = Odontograma::where('dni',$request->dni)->get();
      $det = DetalleOdontograma::where('dni',$request->dni)->get();
      
      return view('detalleOdontograma')->with('odontogramas',$odon)->with('detalles',$det);
    }
    public function searchHistorial(Request $request)
    {
      $output ="";
      $status = $request->status;
      $today = date("Y-m-d");
      if ($request->ajax())
      {

            if($status == "dni")
            {
              $pacientes = DB::table('pacientes')
                        ->join('historials', 'pacientes.dni', '=', 'historials.dni')
                        ->select('pacientes.*', 'historials.*')->where('historials.estado',"guardado")->where('pacientes.dni','LIKE','%'.$request->search.'%')->get();
            }
            else {
              $pacientes = DB::table('pacientes')
                        ->join('historials', 'pacientes.dni', '=', 'historials.dni')
                        ->select('pacientes.*', 'historials.*')->where('historials.estado',"guardado")->where('pacientes.apPaterno','LIKE','%'.$request->search.'%')->get();

            }


          if($pacientes)
          {

              $valor = "";
              for($i=0; $i< count($pacientes); $i++)
              {
                /*if($pacientes[$i]->fechaHistorial < $today) {
                  $porcionTD = '<td><center><button type="button" class="btn btn-info" onclick="alerta()"><i class="glyphicon glyphicon-pencil" align="right"></i></button></center></td>';
                }elseif($pacientes[$i]->fechaHistorial == $today) {
                  $porcionTD = '<td class="success"><center><form action="modificarHistorial" method="GET"><input type="hidden" name="idHistorial" id="idHistorial" value="'.$pacientes[$i]->idHistorial.'"><button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button></form></center></td>';
                }*/
                $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                '<td>'.$pacientes[$i]->nombres.'</td>'.
                                '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                '<td>'.$pacientes[$i]->fechaHistorial.'</td>'.
                                 //$porcionTD.
                                 '<td>
                                  <form action="verHistorial" method="GET">
                                    <input type="hidden" name="idHistorial" id="idHistorial" value="'.$pacientes[$i]->idHistorial.'"">
                                    <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-zoom-in" align="right"></i></button>
                                  </form>
                                 </td>'.
                            '</tr>';

              }
              $output = $valor;
              return Response($output);

          }
      }
    }
    public function searchPacienteHistorial(Request $request)
    {
      $output ="";
      $status = $request->status;
      if ($request->ajax())
      {
        if($status == "dni")
        {
          $pacientes = Paciente::where('dni','LIKE','%'.$request->search.'%')->get();
        }
        else {
          $pacientes = Paciente::where('apPaterno','LIKE','%'.$request->search.'%')->get();
        }
          if($pacientes)
          {
              foreach ($pacientes as $key => $paciente) {
                  $output = '<tr>'.'<td>'.$paciente->dni.'</td>'.
                                  '<td>'.$paciente->nombres.'</td>'.
                                  '<td>'.$paciente->apPaterno.'</td>'.
                                  '<td>'.$paciente->apMaterno.'</td>'.

                                   '<td>
                                     <form action="realizarHistorial" method="GET">
                                       <input type="hidden" name="dni" id="dni" value="'. $paciente->dni.'">
                                       <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                     </form>
                                   </td>'.
                              '</tr>';
              }
              return Response($output);
          }
      }
    }
    public function searchBusquedaRapida(Request $request)
    {
      $output ="";
      $status = $request->status;
      $today = date("Y-m-d");
      if ($request->ajax())
      {

            if($status == "dni")
            {

              $pacientes = DB::table('pacientes')
                        ->join('historials', 'pacientes.dni', '=', 'historials.dni')
                        ->select('pacientes.*', 'historials.*')->where('historials.estado',"guardado")->where('pacientes.dni','LIKE','%'.$request->search.'%')->groupBy('pacientes.dni')->get();
            }
            else {
              $pacientes = DB::table('pacientes')
                        ->join('historials', 'pacientes.dni', '=', 'historials.dni')
                        ->select('pacientes.*', 'historials.*')->where('historials.estado',"guardado")->where('pacientes.apPaterno','LIKE','%'.$request->search.'%')->groupBy('pacientes.dni')->get();

            }


          if($pacientes)
          {

              $valor = "";
              for($i=0; $i< count($pacientes); $i++)
              {

                $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                '<td>'.$pacientes[$i]->nombres.' '.$pacientes[$i]->apPaterno.' '.$pacientes[$i]->apMaterno.'</td>'.
                                '<td>'.$pacientes[$i]->fechaHistorial.'</td>'.
                                '<td>'.$pacientes[$i]->diagnostico.'</td>'.
                                '<td>'.$pacientes[$i]->tratamiento.'</td>'.
                                 
                            '</tr>';

              }
              $output = $valor;
              return Response($output);

          }
      }
    }
    public function searchReceta(Request $request)
    {
      $output ="";
      $status = $request->status;
      $today = date("Y-m-d");
      if ($request->ajax())
      {

            if($status == "dni")
            {
              $pacientes = DB::table('pacientes')
                        ->join('receta_cabeceras', 'pacientes.dni', '=', 'receta_cabeceras.idPaciente')
                        ->select('pacientes.*', 'receta_cabeceras.*')->where('receta_cabeceras.estado',"guardado")->where('pacientes.dni','LIKE','%'.$request->search.'%')->get();
            }
            else {
              $pacientes = DB::table('pacientes')
                        ->join('receta_cabeceras', 'pacientes.dni', '=', 'receta_cabeceras.idPaciente')
                        ->select('pacientes.*', 'receta_cabeceras.*')->where('receta_cabeceras.estado',"guardado")->where('pacientes.apPaterno','LIKE','%'.$request->search.'%')->get();

            }


          if($pacientes)
          {

              $valor = "";
              for($i=0; $i< count($pacientes); $i++)
              {

                $valor = $valor.'<tr>'.'<td>'.$pacientes[$i]->dni.'</td>'.
                                '<td>'.$pacientes[$i]->nombres.'</td>'.
                                '<td>'.$pacientes[$i]->apPaterno.'</td>'.
                                '<td>'.$pacientes[$i]->apMaterno.'</td>'.
                                '<td>'.$pacientes[$i]->fechaReceta.'</td>'.
                                 '<td>
                                  <form action="modificarReceta" method="GET">
                                    <input type="hidden" name="idReceta" id="idReceta" value="'.$pacientes[$i]->idReceta.'"">
                                    <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-zoom-in" align="right"></i></button>
                                  </form>
                                 </td>'.
                            '</tr>';

              }
              $output = $valor;
              return Response($output);

          }
      }
    }
    public function searchPacienteCitaSecretario(Request $request)
    {
      $output ="";
      $status = $request->status;
      if ($request->ajax())
      {
        if($status == "dni")
        {
          $pacientes = Paciente::where('dni','LIKE','%'.$request->search.'%')->get();
        }
        else {
          $pacientes = Paciente::where('apPaterno','LIKE','%'.$request->search.'%')->get();
        }
          if($pacientes)
          {
              foreach ($pacientes as $key => $paciente) {
                  $output = '<tr>'.'<td>'.$paciente->dni.'</td>'.
                                  '<td>'.$paciente->nombres.'</td>'.
                                  '<td>'.$paciente->apPaterno.'</td>'.
                                  '<td>'.$paciente->apMaterno.'</td>'.

                                   '<td>
                                     <form action="realizarCitaSecretario" method="GET">
                                       <input type="hidden" name="dni" id="dni" value="'. $paciente->dni.'">
                                       <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-pencil" align="right"></i></button>
                                     </form>
                                   </td>'.
                              '</tr>';
              }
              return Response($output);
          }
      }
    }
    
}
