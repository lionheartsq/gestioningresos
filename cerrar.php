<?php
$Datetime = 'America/Bogota';
date_default_timezone_set($Datetime);

$fecha = date("y-m-d");
$hoy="20$fecha";

include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");

$totalimporte=$_GET['totalimporte'];
$idfacturas=$_GET['idfacturas'];
$idclientes=$_GET['idclientes'];

if($idclientes==1){$tipopago=1;}
else if($idclientes==7){$tipopago=2;}
else{$tipopago=$_GET['tipopago'];}

//tipopago 2 es contado 1 es credito
//se actualiza la factura con el valor total
	$sql="UPDATE facturas SET total='$totalimporte',tipo='$tipopago' 
	where idfacturas='$idfacturas'";	

	$result = mysqli_query($conx,$sql);
	
	$rs = mysqli_query($conx,"SELECT @@identity AS id");
	if ($row = mysqli_fetch_row($rs)) {
		$idcl = trim($row[0]);
	}

//si es venta interna
	if($tipopago==1){
		
		$sqlasi="INSERT INTO asientos(fecha,concepto,detalle,idtipologia) 
		VALUES ('$hoy','Venta Interna','$idfacturas','2')";	
		$resultasi = mysqli_query($conx,$sqlasi);

		$idmovimientos=mysqli_insert_id($conx);

		$query2="INSERT INTO mayor(fecha,valorentrada,valorsalida,idasientos) 
		VALUES('$hoy','0','$totalimporte','$idmovimientos')";
		$result2=mysqli_query($conx,"$query2");
		
		$query3="INSERT INTO tienda(fecha,valorentrada,valorsalida,idclientes) 
		VALUES('$hoy','0','$totalimporte','$idclientes')";
		$result3=mysqli_query($conx,"$query3");		
	}

//si es contado
	else if($tipopago==2){

		$sqlasi="INSERT INTO asientos(fecha,concepto,detalle,idtipologia) 
		VALUES ('$hoy','Factura POS','$idfacturas','1')";	
		$resultasi = mysqli_query($conx,$sqlasi);

		$idmovimientos=mysqli_insert_id($conx);

		$query2="INSERT INTO mayor(fecha,valorentrada,valorsalida,idasientos) 
		VALUES('$hoy','$totalimporte','0','$idmovimientos')";
		$result2=mysqli_query($conx,"$query2");
		
		$query3="INSERT INTO tienda(fecha,valorentrada,valorsalida,idclientes) 
		VALUES('$hoy','$totalimporte','$totalimporte','$idclientes')";
		$result3=mysqli_query($conx,"$query3");		
	}
	
//si es venta prepagada
	else if($tipopago==3){

		$sqlasi="INSERT INTO asientos(fecha,concepto,detalle,idtipologia) 
	VALUES ('$hoy','Tienda','$idfacturas','1')";	
		$resultasi = mysqli_query($conx,$sqlasi);

		$idmovimientos=mysqli_insert_id($conx);

		$query2="INSERT INTO mayor(fecha,valorentrada,valorsalida,idasientos) 
		VALUES('$hoy','$totalimporte','0','$idmovimientos')";
		$result2=mysqli_query($conx,"$query2");
		
		$query3="INSERT INTO tienda(fecha,valorentrada,valorsalida,idclientes) 
		VALUES('$hoy','0','$totalimporte','$idclientes')";
		$result3=mysqli_query($conx,"$query3");		
	}	

/* descomentariar baño y peluqueria */
$searchd="select * from detallefactura where idfacturas='$idfacturas'";
$resultd = mysqli_query($conx,"$searchd");
while ($resultpagd = mysqli_fetch_array($resultd)) {
$idproductos=$resultpagd['idproductos'];
$valor=$resultpagd['total'];
if($idproductos==66){ //va a cifuentes 226
$sqlad="INSERT into tienda (fecha,valorentrada,valorsalida,idclientes) values ('$hoy','$valor','0','226')";	
$resultsad = mysqli_query($conx,$sqlad);	
	}
else if($idproductos==68){ //va a caro 238
$sqlad="INSERT into tienda (fecha,valorentrada,valorsalida,idclientes) values ('$hoy','5000','0','238')";	
$resultsad = mysqli_query($conx,$sqlad);	
	}	
}
//$url="cerrado.php?idfacturas=$idfacturas&idclientes=$idclientes";	
//echo $url;	
header("Location:cerrado.php?idfacturas=$idfacturas&idclientes=$idclientes");
?>