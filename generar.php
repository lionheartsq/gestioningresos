<?php
define('tFPDF_FONTPATH','font/');
require('tfpdf.php');

class PDF extends tFPDF
{
function EAN13($x, $y, $barcode, $h=16, $w=.35)
{
	$this->Barcode($x,$y,$barcode,$h,$w,13);
	$this->SetFont('Arial','B',12);
}

function UPC_A($x, $y, $barcode, $h=16, $w=.35)
{
	$this->Barcode($x,$y,$barcode,$h,$w,12);
}

function GetCheckDigit($barcode)
{
	//Compute the check digit
	$sum=0;
	for($i=1;$i<=11;$i+=2)
		$sum+=3*$barcode[$i];
	for($i=0;$i<=10;$i+=2)
		$sum+=$barcode[$i];
	$r=$sum%10;
	if($r>0)
		$r=10-$r;
	return $r;
}

function TestCheckDigit($barcode)
{
	//Test validity of check digit
	$sum=0;
	for($i=1;$i<=11;$i+=2)
		$sum+=3*$barcode[$i];
	for($i=0;$i<=10;$i+=2)
		$sum+=$barcode[$i];
	return ($sum+$barcode[12])%10==0;
}

function Barcode($x, $y, $barcode, $h, $w, $len)
{
	//Padding
	$barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
	if($len==12)
		$barcode='0'.$barcode;
	//Add or control the check digit
	if(strlen($barcode)==12)
		$barcode.=$this->GetCheckDigit($barcode);
	elseif(!$this->TestCheckDigit($barcode))
		$this->Error('Incorrect check digit');
	//Convert digits to bars
	$codes=array(
		'A'=>array(
			'0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
			'5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
		'B'=>array(
			'0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
			'5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
		'C'=>array(
			'0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
			'5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
		);
	$parities=array(
		'0'=>array('A','A','A','A','A','A'),
		'1'=>array('A','A','B','A','B','B'),
		'2'=>array('A','A','B','B','A','B'),
		'3'=>array('A','A','B','B','B','A'),
		'4'=>array('A','B','A','A','B','B'),
		'5'=>array('A','B','B','A','A','B'),
		'6'=>array('A','B','B','B','A','A'),
		'7'=>array('A','B','A','B','A','B'),
		'8'=>array('A','B','A','B','B','A'),
		'9'=>array('A','B','B','A','B','A')
		);
	$code='101';
	$p=$parities[$barcode[0]];
	for($i=1;$i<=6;$i++)
		$code.=$codes[$p[$i-1]][$barcode[$i]];
	$code.='01010';
	for($i=7;$i<=12;$i++)
		$code.=$codes['C'][$barcode[$i]];
	$code.='101';
	//Draw bars
	for($i=0;$i<strlen($code);$i++)
	{
		if($code[$i]=='1')
			$this->Rect($x+$i*$w,$y,$w,$h,'F');
	}
	//Print text under barcode
	$this->SetFont('Arial','',12);	
	$this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
}
}

$pdf=new PDF();

$equipo = array("PAN VILLABEL"=>"111222200001","GALLETAS DE MAIZ VILLABEL"=>"111222200002","CUCAS VILLABEL"=>"111222200003","COCACOLA 1,5 LT"=>"111222200004","COCACOLA 250 ML"=>"111222200005","POSTOBON 2 L"=>"111222200006","AREQUIPE"=>"111222200007","ROSCONES"=>"111222200008","HAWALLANOS"=>"111222200009","BOCADILLO COMBINADO"=>"111222200010","BOCADILLO HOJA"=>"111222200011","BOMBON SURTIDO"=>"111222200012","BOMBON SAL"=>"111222200013","CAPRI"=>"111222200014","RONDALLA"=>"111222200015","COFEE LIGHT"=>"111222200016","HOJALDRAS"=>"111222200017","BUBALUU"=>"111222200018","SALCHICHON CARNE"=>"111222200019","SALCHICHON POLLO"=>"111222200020","QUESILLO"=>"111222200021","BOMBAS DE COCO"=>"111222200022","PAN RICO"=>"111222200023","LENGUAS"=>"111222200024","MANI DULCE"=>"111222200025","PAPA PERRO"=>"111222200026","GELATINA DE PATA"=>"111222200027","GALLETA RIZADA"=>"111222200028","PAPA MIXTOS"=>"111222200029","PAPA POBRE"=>"111222200030","DEDITOS BOCADILLO"=>"111222200031","EMPANADAS"=>"111222200032");

$flag=0;
 
foreach($equipo as $nombre=>$codigo)
	{
if(($flag % 5)==0){
	$pdf->AddPage();
	$v=20;
}
$name=$nombre;

$pdf->EAN13(80,$v,$codigo);	
// Salto de línea
$pdf->Ln(40);	
$pdf->Cell(70,0);	
$pdf->Cell(80,0,$name);		
$pdf->Ln(10);
$pdf->Cell(30,0);
$pdf->Cell(80,0,"-----------------------------------------------------------------------------------");

$v=($v+50);

$flag=$flag+1;
	}	

$pdf->Output();
?>
