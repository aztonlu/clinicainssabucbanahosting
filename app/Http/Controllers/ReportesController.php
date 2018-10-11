<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Anouar\Fpdf\Fpdf as baseFpdf;
use App\Paciente;
use App\Historial;
use App\ExamenAuxiliar;
use App\Http\Requests;
use DB;

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
      $this->Cell(20,20,iconv('UTF-8', 'ISO-8859-2','Reporte Médico'),0,0,'C');
      // Line break
      $this->Ln(5);
      $this->Cell(55);
      // Title
      $this->Cell(20,20,iconv('UTF-8', 'ISO-8859-2','Clínica de Salud....'),0,0,'C');
      // Line break
      $this->Ln(5);
      $this->Cell(55);
      // Title
      $this->Cell(20,20,iconv('UTF-8', 'ISO-8859-2','Número de contacto....'),0,0,'C');
      // Line break
      $this->Ln(20);
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
class ReportesController extends Controller
{
    //



    public function mostrarReporte(Request $request)
    {
      $idHistorial = $request->idHistorial;
      $dni = Historial::where('idHistorial',$idHistorial)->value('dni');
      $paciente = Paciente::where('dni',$dni)->get();
      $historial = Historial::where('idHistorial',$idHistorial)->get();
      $examenAuxiliar = ExamenAuxiliar::where('idHistorial',$idHistorial)->get();

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
          $pdf->Cell(0,20,$pac->apPaterno.' '.$pac->apMaterno.' '.$pac->nombres,0,1);
          $pdf->Ln(-3);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,0,iconv('UTF-8', 'ISO-8859-2','Sexo:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->Cell(50,0,$pac->sexo,0,1);
          $pdf->Ln(7);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,0,iconv('UTF-8', 'ISO-8859-2','Teléfono:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->Cell(50,0,$pac->telefono,0,1);
          $pdf->Ln(7);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,0,iconv('UTF-8', 'ISO-8859-2','Edad:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->Cell(50,0,$pac->edad,0,1);
          $pdf->Ln(0);
        }
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','HISTORIALES MÉDICOS'),0,0,'');
        $pdf->Ln(5);
        foreach ($historial as $his) {
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,20,iconv('UTF-8', 'ISO-8859-2','Fecha Historial:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->Cell(0,20,$his->fechaHistorial,0,1);
          $pdf->Ln(-4);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Tiempo de la Enfermedad:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->MultiCell(0,3,$his->tiempoEnfermedad,0,1);
          $pdf->Ln(4);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Forma de Inicio:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->MultiCell(0,3,$his->formaInicio,0,1);
          $pdf->Ln(4);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Curso:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->MultiCell(0,3,$his->curso,0,1);
          $pdf->Ln(4);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Signos:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->MultiCell(0,3,$his->signos,0,1);
          $pdf->Ln(4);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Relato:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->MultiCell(0,3,$his->relato,0,1);
          $pdf->Ln(4);
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Examen Físico:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->MultiCell(0,3,$his->examenFisico,0,1);
          $pdf->Ln(4);
        }
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Exámenes auxiliares:'),0,0,'');
        $pdf->SetFont('Times','',10);
        $pdf->Ln(4);
        foreach ($examenAuxiliar as $exa) {
          $pdf->SetFont('Times','B',10);
          $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2','Nombre del examen:'),0,0,'');
          $pdf->SetFont('Times','',10);
          $pdf->MultiCell(0,3,$exa->nombreExamen,0,1);
          $pdf->Ln(4);
          //$pdf->Image('img/logo.png', 5, 70, 33.78);
            $pdf->Cell(50,3,iconv('UTF-8', 'ISO-8859-2',''),0,0,'');$pdf->Image($exa->rutaImagen);
          $pdf->setX(20);
          $pdf->Ln(4);
        }

        $pdf->Output();
        exit;

    }
}
