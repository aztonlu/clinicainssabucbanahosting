<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\UsuarioRequest;
use App\Paciente;
use App\Cita;
use App\Odontograma;
use App\DetalleOdontograma;
use DB;
use Auth;
use App\User;
use App\Historial;
use App\ExamenAuxiliar;
use App\RecetaCabecera;
use App\RecetaCuerpo;
use Anouar\Fpdf\Fpdf as baseFpdf;
use Illuminate\Support\Facades\Redirect;

class PDF extends baseFpdf
{
  // Page header
  function Header()
  {
       // Logo
      $this->Image('img/logo.png',10,15,50);
      // Arial bold 15
      $this->SetFont('Arial','B',10);
      // Move to the right
      $this->Cell(55);
      // Title
      $this->Cell(90,20,iconv('UTF-8', 'ISO-8859-2','INSSABUC'),0,0,'C');
      // Line break
      $this->Ln(5);
      $this->Cell(55);
      // Title
      $this->Cell(90,20,iconv('UTF-8', 'ISO-8859-2','CLINICA DE SALUD BUCAL'),0,0,'C');
      // Line break
      $this->Ln(5);
      $this->Cell(55);
      // Title
      $this->Cell(90,20,iconv('UTF-8', 'ISO-8859-2','C.D. Juober Payé Luna - COP. 19326'),0,0,'C');
      // Line break
      $this->Ln(5);
      $this->SetFont('Arial','',8);
      $this->Cell(190,20,iconv('UTF-8', 'ISO-8859-2','Cirugia Bucal - Endodoncia - Ortodoncia - Rehabilitacion oral - Maquillaje Dental'),0,0,'C');
      $this->Ln(5);
      $this->Cell(190,20,iconv('UTF-8', 'ISO-8859-2','Av. Velasco Astete. Urb. Kennedy "B" F 11 - Urb. Ttio la Florida, Jr. Los Sauces LL-1 2do Piso Of. 204 (Frente al templo de Ttio)'),0,0,'C');
      $this->Ln(5);
      $this->Cell(190,20,iconv('UTF-8', 'ISO-8859-2','Citas y Emergencias: 984 745 898 - 084 607435'),0,0,'C');
      $this->Ln(14);
      $this -> Cell(190,0,'',1,0,'C');
      // Line break
      $this->Ln(7);
  }

  // Page footer
  function Footer()
  {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // Page number
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pacientes = Paciente::paginate(10);
      return view('home', ['pacientes' => $pacientes]);
    }
    public function secretario()
    {
      $userLugar = User::where('id',Auth::user()->id)->value('lugar');
      $pacientes = Paciente::paginate(10);
      return view('secretario', ['pacientes' => $pacientes,'lugar' => $userLugar]);

    }
    public function indexCitas()
    {
      $carbon = new \Carbon\Carbon();
        $dt= $carbon::now();
        $hoy =$dt->toDateString();
      $citas = DB::table('pacientes')
            ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
            ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita','citas.lugar')->where('citas.fechaCita',$hoy)->orderby('citas.fechaCita','asc')
            ->paginate(10);
      return view('citas')->with('citas',$citas);
    }
    public function secretariocitas()
    {
      $carbon = new \Carbon\Carbon();
        $dt= $carbon::now();
        $hoy =$dt->toDateString();
      $citas = DB::table('pacientes')
            ->join('citas', 'pacientes.dni', '=', 'citas.idPaciente')
            ->select('pacientes.*', 'citas.fechaCita','citas.estado','citas.idCita')->where('citas.fechaCita',$hoy)->where('citas.lugar',Auth::user()->lugar)->orderby('citas.fechaCita','asc')
            ->paginate(10);
      return view('secretariocitas')->with('citas',$citas);
    }
    public function recetas()
    {
      $recetas = DB::table('pacientes')
                ->join('receta_cabeceras', 'pacientes.dni', '=', 'receta_cabeceras.idPaciente')
                ->select('pacientes.*', 'receta_cabeceras.*')->where('receta_cabeceras.estado',"guardado")->orderby('receta_cabeceras.fechaReceta','desc')
                ->paginate(10);
      return view('receta')->with('recetas',$recetas);
    }
    public function indexHistorial()
    {
      $historiales = DB::table('pacientes')
                ->join('historials', 'pacientes.dni', '=', 'historials.dni')
                ->select('pacientes.*', 'historials.*')->where('historials.estado',"guardado")->orderby('historials.fechaHistorial','desc')
                ->paginate(10);
      return view('historial')->with('historiales',$historiales);
      
    }
    public function accesos()
    {
      $usuarios = User::all();
      return view('accesos')->with('usuarios',$usuarios);
    }
    public function formularioUsuario()
    {
      return view('formularioUsuario');
    }
    public function registroUsuario(UsuarioRequest $request)
    {
      $user = new User;
      $user->name = $request->nombres.' '.$request->apPaterno.' '.$request->apMaterno;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->tipo = $request->tipo;
      $user->lugar = $request->lugar;
      $user->save();
      return Redirect::action('HomeController@accesos')->with('success','¡Felicitaciones!,El usuario ha sido creado con éxito');
    }
    public function editarUsuario(Request $request)
    {
      $idUser = $request->id;
      $usuarios = User::where('id',$idUser)->get();
      return view('updateUsuario')->with('usuarios',$usuarios);

    }
    public function modificarUsuario(Request $request)
    {
      $idUser = $request->id;
      if($request->password == "")
      {
        User::where('id', $idUser)->update(['name' => $request->nombres,'email' => $request->email,'tipo' => $request->tipo, 'lugar' => $request->lugar]);
      }
      else {
          User::where('id', $idUser)->update(['name' => $request->nombres,'email' => $request->email,'password' => bcrypt($request->password),'tipo' => $request->tipo, 'lugar' => $request->lugar]);
      }

      return Redirect::action('HomeController@accesos')->with('success','¡Felicitaciones!,El usuario ha sido modificado con éxito');
    }
    public function eliminarUsuario(Request $request)
    {
      $idUser = $request->id;
      $deletedRows = User::where('id', $idUser)->delete();
      return Redirect::action('HomeController@accesos')->with('success','¡Felicitaciones!,El usuario ha sido eliminado con éxito');
    }
    public function indexReportes()
    {
      return view('reportes');
    }
    public function indexbusquedaRapida()
    {
      $historiales = DB::table('pacientes')
                ->join('historials', 'pacientes.dni', '=', 'historials.dni')
                ->select('pacientes.*', 'historials.*')->groupBy('pacientes.dni')->where('historials.estado',"guardado")->orderby('historials.fechaHistorial','desc')
                ->paginate(10);
      return view('busquedaRapida')->with('historiales',$historiales);
    }
    public function verHistorial(Request $request)
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
      return view('vistaHistorial')->with('historiales',$historiales)->with('examenes',$examenAuxiliar);
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
    public function reporteReceta(Request $request)
    {
      $idReceta = $request->idReceta;
      $recetas_cabecera = DB::table('pacientes')
                ->join('receta_cabeceras', 'pacientes.dni', '=', 'receta_cabeceras.idPaciente')
                ->select('pacientes.*', 'receta_cabeceras.*')->where('receta_cabeceras.estado',"guardado")->where('receta_cabeceras.idReceta', $idReceta)
                ->get();
      $recetas_cuerpo = RecetaCuerpo::where('idReceta',$idReceta)->get();

      $pdf = new PDF();
      $pdf->AliasNbPages();
      $pdf->AddPage();
      foreach($recetas_cabecera as $pac)
      {
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','Nombre Completo:'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->Cell(0,20,utf8_decode($pac->apPaterno.' '.$pac->apMaterno.' '.$pac->nombres),0,1,'');
        $pdf->Ln(-3);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Dx:'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->MultiCell(0,3,utf8_decode($pac->diagnostico),0,1);
        $pdf->Ln(4);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Rp/'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->MultiCell(0,3,'',0,1);
        $pdf->Ln(4);
      }
      foreach($recetas_cuerpo as $pac)
      {
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','Nombre Medicamento:'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->Cell(0,20,utf8_decode($pac->nombreMedicamento),0,1);
        $pdf->Ln(-7);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Dosis:'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->MultiCell(0,3,utf8_decode($pac->dosis),0,1);
        $pdf->Ln(2);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Via:'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->MultiCell(0,3,utf8_decode($pac->via),0,1);
        $pdf->Ln(2);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Frecuencia:'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->MultiCell(0,3,utf8_decode($pac->frecuencia),0,1);
        $pdf->Ln(2);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Duracion:'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->MultiCell(0,3,utf8_decode($pac->duracion),0,1);
        $pdf->Ln(2);
      }
      $pdf->Output();
      exit;
    }
    public function mostrarReporte(Request $request)
    {
      $dni = $request->dni;
      
      $paciente = Paciente::where('dni',$dni)->get();
      $historial = Historial::where('dni',$dni)->get();
      $odontograma = Odontograma::where('dni',$dni)->get();
      $odon = Odontograma::where('dni',$dni)->pluck('idOdontograma');

      $det = DetalleOdontograma::whereIn('idOdontograma',$odon)->get();
      


      $odontograma_paciente = DB::table('pacientes')
                ->join('odontogramas', 'pacientes.dni', '=', 'odontogramas.dni')
                ->select('pacientes.*', 'odontogramas.*')->where('odontogramas.dni',$dni)
                ->get();

      $costo_odontograma = DB::table('pacientes')
                ->join('detalle_odontogramas', 'pacientes.dni', '=', 'detalle_odontogramas.dni')
                ->select('pacientes.*', 'detalle_odontogramas.*')->where('detalle_odontogramas.dni',$dni)
                ->get();

      $concepto_atencion = DB::table('pacientes')
                ->join('detalle_odontogramas', 'pacientes.dni', '=', 'detalle_odontogramas.dni')
                ->select('pacientes.dni', 'detalle_odontogramas.concepto', 'detalle_odontogramas.precio', 'detalle_odontogramas.created_at')->where('detalle_odontogramas.dni',$dni)
                ->get();
      /*foreach($odontograma as $odo) 
          
          foreach($det as $detalle) { 
              if($odo->idOdontograma == $detalle->idOdontograma){
                $detalle->concepto ; $detalle->precio;
              }
              else
              {

              }        
          }        
      }*/
      

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','DATOS GENERALES'),0,0,'');
        $pdf->Ln(5);

        foreach($paciente as $pac)
        {
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','Nombre Completo:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->Cell(0,20,utf8_decode($pac->apPaterno.' '.$pac->apMaterno.' '.$pac->nombres),0,1,'');
          $pdf->Ln(-4);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,0,iconv('UTF-8', 'ISO-8859-2','Sexo:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->Cell(50,0,utf8_decode($pac->sexo),0,1);
          $pdf->Ln(7);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,0,iconv('UTF-8', 'ISO-8859-2','Teléfono:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->Cell(50,0,utf8_decode($pac->telefono),0,1);
          $pdf->Ln(7);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,0,iconv('UTF-8', 'ISO-8859-2','Edad:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->Cell(50,0,utf8_decode($pac->edad),0,1);
          $pdf->Ln(0);

        }
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','HISTORIALES ODONTOLÓGICOS'),0,0,'');
        $pdf->Ln(5);
        
        foreach($odontograma_paciente as $odonto)
        {
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','Fecha:'),0,0,'');
          $pdf->Cell(0,20,utf8_decode($odonto->created_at),0,1);
          $pdf->Ln(12);
          $pdf->SetFont('Times','',10);
          $pdf->Cell(10,3,iconv('UTF-8', 'ISO-8859-2',''),0,0,'');$pdf->Image($odonto->imagen);

          $pdf->setX(20);
          $pdf->Ln(-4);


          $pdf->Ln(20);

        }

        /*foreach($costo_odontograma as $costo)
        {
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','Costo:'),0,0,'');
          $pdf->Cell(0,20,utf8_decode($costo->precio),0,1);
          $pdf->Ln(12);
          $pdf->Ln(-4);

          $pdf->Ln(0);

        }*/


        foreach($concepto_atencion as $concep)
        {

          $pdf->SetFont('Times','B',10);
          $pdf->Cell(30,20,iconv('UTF-8', 'ISO-8859-2','Concepto:'),1,0,'');
          $pdf->Cell(0,20,utf8_decode($concep->concepto),1,1);
          $pdf->Cell(30,20,iconv('UTF-8', 'ISO-8859-2','precio:'),1,0,'');
          $pdf->Cell(0,20,utf8_decode($concep->precio),1,1);
          $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','Fecha de procedimiento:'),1,0,'');
          $pdf->Cell(0,20,utf8_decode($concep->created_at),1,1);
          $pdf->Ln(12);
          $pdf->Ln(2);

          $pdf->Ln(12);

        }


        $pdf->Output();
    }
    public function back()
    {

      exec("bash backupmend.sh");


    }
}
