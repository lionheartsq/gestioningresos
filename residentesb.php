<?php
if (isset($_GET['term'])){

$flag=$_GET['term'];

header('Content-type: application/json');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");
include_once('bas/conx.php'); //Conexion a nueva db 

$sqld="select distinct idresidentes,nombresr,apellidosr,documentor,estado from residentes where 
(documentor like '%" . $_GET['term'] . "%' and (estado='A' or estado='E')) or 
(apellidosr like '%" . $_GET['term'] . "%' and (estado='A' or estado='E')) LIMIT 0 ,50";
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$selectd=mysqli_query($con,$sqld);

$resultd = array();
$total=0;

	while ($row = mysqli_fetch_assoc($selectd)) {
		$row_array['value'] = $row['documentor']." ".$row['nombresr']." ".$row['apellidosr'];
		$row_array['idresidentes']=$row['idresidentes'];
		$row_array['cedula']=$row['documentor'];
		$row_array['nombrer']=$row['nombresr']." ".$row['apellidosr'];
		$idresi=$row['idresidentes'];

$queryur="select SUM(valorentrada) as valorentrada,sum(valorsalida) as valorsalida 
from tienda where idresidentes=$idresi;";	

$result1r=mysqli_query($conx,$queryur);
while ($resultxr = mysqli_fetch_array($result1r)) {
$entradas=$resultxr['valorentrada'];
$salidas=$resultxr['valorsalida'];
}
$saldototal=$entradas-$salidas;
		$row_array['saldototal']=$saldototal;

		array_push($resultd,$row_array);
}
echo json_encode($resultd);
}
?>