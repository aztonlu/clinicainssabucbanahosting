<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cita;
use App\Paciente;
use App\Http\Requests;
use DB;
use Auth;
use App\Http\Requests\CitaRequest;
use Illuminate\Support\Facades\Redirect;

class CitasController extends Controller
{
    //
    public function index()
    {
      $citas = DB::table('pacientes')
            ->join('citas', 'pacientes.idPaciente', '=', 'citas.idPaciente')
            ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')
            ->get();
      return view('citas')->with('citas',$citas);
    }
    public function realizarCita(Request $request)
    {
      $numCitas = Cita::where('idPaciente',$request->dni)->count();
      $paciente = Paciente::where('dni',$request->dni)->get();
      return view('formCita')->with('pacientes',$paciente)->with('numCitas',$numCitas);
    }
    public function realizarCitaSecretario(Request $request)
    {
      $numCitas = Cita::where('idPaciente',$request->dni)->count();
      $paciente = Paciente::where('dni',$request->dni)->get();
      return view('formCitaSecretario')->with('pacientes',$paciente)->with('numCitas',$numCitas);
    }
    public function registroCita(CitaRequest $request)
    {
      $idPaciente = $request->idPaciente;
      $citas = new Cita;
      $citas->fechaCita = $request->fechaCita;
      $citas->idPaciente = $idPaciente;
      $citas->estado = $request->estado;
      $citas->idUser = Auth::user()->id;
      $citas->lugar = $request->lugar;
      $citas->save();
      return Redirect::action('HomeController@indexCitas')->with('success','¡Felicitaciones!,La cita ha sido creada con éxito');
    }
    public function registroCitaSecretario(CitaRequest $request)
    {
      $idPaciente = $request->idPaciente;
      $citas = new Cita;
      $citas->fechaCita = $request->fechaCita;
      $citas->idPaciente = $idPaciente;
      $citas->estado = $request->estado;
      $citas->idUser = Auth::user()->id;
      $citas->lugar = Auth::user()->lugar;
      $citas->save();
      return Redirect::action('HomeController@secretariocitas')->with('success','¡Felicitaciones!,La cita ha sido creada con éxito');
    }
    public function modificarCita(Request $request)
    {
      $idCita = $request->idCita;
      $citas = DB::table('pacientes')
            ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
            ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita' ,'citas.lugar')->where('idCita',$idCita)
            ->get();
      return view('updateCita')->with('pacientes',$citas);
    }
    public function modificarCitaSecretario(Request $request)
    {
      $idCita = $request->idCita;
      $citas = DB::table('pacientes')
            ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
            ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita','citas.lugar')->where('idCita',$idCita)
            ->get();
      return view('updateCitaSecretario')->with('pacientes',$citas);
    }
    public function updateRegistroCita(Request $request)
    {
      $idCita = $request->idCita;
      $lugar = $request->lugar;
      Cita::where('idCita', $idCita)->update(['fechaCita' => $request->fechaCita,'estado'=>$request->estado,'lugar' =>$lugar]);
      return Redirect::action('HomeController@indexCitas')->with('success','¡Felicitaciones!,La cita ha sido modificada con éxito');


    }
    public function updateRegistroCitaSecretario(Request $request)
    {
      $idCita = $request->idCita;
      Cita::where('idCita', $idCita)->update(['fechaCita' => $request->fechaCita,'estado'=>$request->estado]);
      return Redirect::action('HomeController@secretariocitas')->with('success','¡Felicitaciones!,La cita ha sido modificada con éxito');
    }
    public function eliminarCita(Request $request)
    {
      $dni = $request->idCita;
      $affectedRows = Cita::where('idCita', '=', $dni)->delete();
      return Redirect::action('CitasController@index')->with('success','¡Felicitaciones!,La cita ha sido eliminada con éxito');
    }
}
