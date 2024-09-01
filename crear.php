<?php
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");
include_once('bas/conx.php'); //Conexion a nueva db 
$Datetime = 'America/Bogota';
date_default_timezone_set($Datetime);
$fecha = date("y-m-d");
$hoy="20$fecha";

$cod=$_POST['cod'];

$sqld="select idresidentes,nombresr,apellidosr,documentor,estado from 
residentes where (documentor='$cod' and (estado='A' or estado='E' or estado='O'))";
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$selectd=mysqli_query($con,$sqld);

$row_cnt = mysqli_num_rows($selectd);
if($row_cnt>0){	
$total=0;

	while ($row = mysqli_fetch_assoc($selectd)) {
		$cedula=$row['documentor'];
		$nombrer=$row['nombresr']." ".$row['apellidosr'];
		$idresi=$row['idresidentes'];

$queryur="select SUM(valorentrada) as valorentrada,sum(valorsalida) as valorsalida 
from tienda where idclientes='$idresi'";	

$result1r=mysqli_query($conx,$queryur);
while ($resultxr = mysqli_fetch_array($result1r)) {
$entradas=$resultxr['valorentrada'];
$salidas=$resultxr['valorsalida'];
}
$saldototal=$entradas-$salidas;
//echo $queryur;
}
header("Location:crearp.php?idclientes=$idresi&fechaf=$hoy&nombre=$nombrer&saldo=$saldototal");	
}
else{
header("Location:index.php?idaviso=$cod");		
}
?>