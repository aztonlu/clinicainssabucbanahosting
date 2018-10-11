<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PacienteRequest;
use App\Http\Requests;
use App\Paciente;
use Auth;
use Illuminate\Support\Facades\Redirect;

class PacienteController extends Controller
{
    //
    public function formPaciente()
    {
      return view('formPaciente');
    }
    public function formPacienteSecretario()
    {
      return view('formPacienteSecretario');
    }
    public function registroPaciente(PacienteRequest $request)
    {
      $paciente = new Paciente;
      $paciente->nombres = $request->nombres;
      $paciente->apPaterno = $request->apPaterno;
      $paciente->apMaterno = $request->apMaterno;
      $paciente->telefono = $request->telefono;
      $paciente->direccion = $request->direccion;
      $paciente->dni = $request->dni;
      $paciente->sexo = $request->sexo;
      $paciente->edad = $request->edad;
      $paciente->estadoCivil = $request->estadoCivil;
      $paciente->antecedentes = $request->antecedentes;
      $paciente->lugar = Auth::user()->lugar;
      $paciente->save();

      return Redirect::action('HomeController@index')->with('success','¡Felicitaciones!,El paciente ha sido creado con éxito');
    }
    public function registroPacienteSecretario(PacienteRequest $request)
    {
      $paciente = new Paciente;
      $paciente->nombres = $request->nombres;
      $paciente->apPaterno = $request->apPaterno;
      $paciente->apMaterno = $request->apMaterno;
      $paciente->telefono = $request->telefono;
      $paciente->direccion = $request->direccion;
      $paciente->dni = $request->dni;
      $paciente->sexo = $request->sexo;
      $paciente->edad = $request->edad;
      $paciente->estadoCivil = $request->estadoCivil;
      $paciente->antecedentes = $request->antecedentes;
      $paciente->lugar = Auth::user()->lugar;
      $paciente->save();

      return Redirect::action('HomeController@secretario')->with('success','¡Felicitaciones!,El paciente ha sido creado con éxito');
    }
    public function modificarPaciente(Request $request)
    {
      $dni = $request->dni;
      $paciente = Paciente::where('dni',$dni)->get();
      return view('updatePaciente')->with('pacientes',$paciente);
    }
    public function modificarPacienteBuscadoSecretario(Request $request)
    {
      $dni = $request->dni;
      $paciente = Paciente::where('dni',$dni)->get();
      return view('updatePacienteSecretario')->with('pacientes',$paciente);
    }
    public function modificarPacienteBuscado()
    {
      $dni = $_GET['dni'];
      $paciente = Paciente::where('dni',$dni)->get();
      return view('updatePaciente')->with('pacientes',$paciente);
    }
    
    public function nuevoOdontograma()
    {
      $dni = $_GET['dni'];
      $paciente = Paciente::where('dni',$dni)->get();
      return view('updatePaciente')->with('pacientes',$paciente);
    }
    public function prueba()
    {
      $dni = $_GET['dni'];
      $paciente = Paciente::where('dni',$dni)->get();
      return view('updatePaciente')->with('pacientes',$paciente);
    }
    //update data
    public function updateRegistroPaciente(Request $request)
    {
      $idPaciente = $request->idPaciente;
      Paciente::where('idPaciente', $idPaciente)->update(['nombres' => $request->nombres,'apPaterno'=> $request->apPaterno,'apMaterno'=> $request->apMaterno,'telefono'=> $request->telefono,'direccion'=> $request->direccion,'sexo'=> $request->sexo,'edad'=> $request->edad,'antecedentes'=>$request->antecedentes,'estadoCivil'=>$request->estadoCivil]);
      return Redirect::action('HomeController@index')->with('success','¡Felicitaciones!,El paciente ha sido modificado con éxito');
    }
    public function updateRegistroPacienteSecretario(Request $request)
    {
      $idPaciente = $request->idPaciente;
      Paciente::where('idPaciente', $idPaciente)->update(['nombres' => $request->nombres,'apPaterno'=> $request->apPaterno,'apMaterno'=> $request->apMaterno,'telefono'=> $request->telefono,'direccion'=> $request->direccion,'sexo'=> $request->sexo,'edad'=> $request->edad,'antecedentes'=>$request->antecedentes,'estadoCivil'=>$request->estadoCivil]);
      return Redirect::action('HomeController@secretario')->with('success','¡Felicitaciones!,El paciente ha sido modificado con éxito');
    }
    //delete data
    public function eliminarPaciente(Request $request)
    {
      $dni = $request->dni;
      $affectedRows = Paciente::where('dni', '=', $dni)->delete();
      return Redirect::action('HomeController@index')->with('success','¡Felicitaciones!,El paciente ha sido eliminado con éxito');
    }
    public function eliminarPacienteBuscado()
    {
      $dni = $_GET['dni'];
      $affectedRows = Paciente::where('dni', '=', $dni)->delete();
      return Redirect::action('HomeController@index')->with('success','¡Felicitaciones!,El paciente ha sido eliminado con éxito');
    }
}
