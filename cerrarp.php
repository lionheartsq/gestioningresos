<?php
session_start();
$fecha = date("y-m-d");
$hoy="20$fecha";

include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");

$totalimportecl=$_GET['totalimportecl'];
$idpedidos=$_GET['idproyectos'];
$facturax=$_GET['factura'];

$sqlins="INSERT INTO pagos(fechaabono,valorpago,abono,idpedidos) 
VALUES ('$hoy','$totalimportecl','0','$idpedidos')";	
$result = mysqli_query($conx,$sqlins);

$sqlas="INSERT INTO asientos(fecha,concepto,detalle,idtipologia`) 
VALUES ('$hoy','Pedido','$factura','2')";	
$resulat = mysqli_query($conx,$sqlas);
		$rs = mysqli_query($conx,"SELECT @@identity AS id");
			if ($row = mysqli_fetch_row($rs)) {
				$idcl = trim($row[0]);
			}

$sqlmay="INSERT INTO mayor(fecha,valorentrada,valorsalida,idasientos) 
VALUES ('$hoy','0','$totalimportecl','$idcl')";	
$resultm = mysqli_query($conx,$sqlmay);

$actu="UPDATE pedidos SET total=$totalimportecl WHERE idpedidos=$idpedidos";
$resultactu = mysqli_query($conx,$actu);

//echo $sql2;
header("Location:cerradop.php?idpedidos=$idpedidos");
?>