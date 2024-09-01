
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$idterapias=$_REQUEST['idterapias'];
	
include_once('bas/conn.php');

require('tfpdf.php');
class PDF extends tFPDF{}

$pdf = new PDF('P','mm',array(139,206));

$pdf->AddPage();
$pdf->SetTextColor(255,0,0);

	
$result=mysqli_query($con,"select terapiac.fecha as fecha, terapiac.colider as colider, terapiac.fallas as fallas, terapiac.observaciones as observaciones, terapiac.ayudas as ayudas, terapiac.idresidentes as idresidentes, residentes.nombresr as nombres, residentes.apellidosr as apellidos from terapiac join residentes on terapiac.idresidentes=residentes.idresidentes where terapiac.idterapiac='$idterapias'");

	while ($resultc = mysqli_fetch_array($result)) {
		$fecha=$resultc['fecha'];
		$colider=$resultc['colider'];
		$fallas=$resultc['fallas'];
		$observaciones=$resultc['observaciones'];
		$ayudas=$resultc['ayudas'];
		$nombres=$resultc['nombres'];
		$apellidos=$resultc['apellidos'];

$pdf->SetFont('Arial','B',8);
$pdf->Cell(113,10,utf8_decode('-------------------------------------//   AYUDAS   //-------------------------------------'));
$pdf->SetFont('Arial','',9);		
$pdf->Ln(15);
$pdf->Cell(113,10,utf8_decode('Fecha: '.$fecha));
$pdf->Ln(5);
$pdf->Cell(113,10,utf8_decode('Colider: '.$colider));
$pdf->Ln(5);
$pdf->MultiCell(113,10,utf8_decode('Residente: '.$nombres.' '.$apellidos));
$pdf->Ln(5);
$pdf->MultiCell(113,10,utf8_decode('Fallas: '.$fallas),1);
$pdf->Ln(5);
$pdf->MultiCell(113,10,utf8_decode('Observaciones: '.$observaciones),1);
$pdf->Ln(5);
$pdf->MultiCell(113,10,utf8_decode('Ayudas: '.$ayudas),1);
$pdf->Ln(15);
$pdf->Cell(113,10,utf8_decode('-------------------------------------//   AYUDAS   //-------------------------------------'));
	}	

$pdf->Output();
}
else {
header("Location:index.php");
}
?>