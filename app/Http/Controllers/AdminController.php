<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests;
use App\User;
use App\Paciente;
use Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
      return view('auth/login');
    }
    public function home()
    {
      $pacientes = Paciente::all();
      return view('home')->with('pacientes',$pacientes);
    }
    public function loginadmin(AdminRequest $request)
    {
      $user = User::where('email',$request->email)->value('tipo');

      if($user == "administrador")
      {
        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))){
            return Redirect::action('HomeController@index');
          
        }else{

            return Redirect::action('AdminController@index')->with('success','El campo contraseña es incorrecto.');
        }
      }
      else
      {
        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))){
            return Redirect::action('HomeController@secretario');
        }else{
            return Redirect::action('AdminController@index')->with('success','El campo contraseña es incorrecto.');
        }
      }

    }
}
