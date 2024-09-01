<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");

$fecha=$_REQUEST['fecha'];
$tipologia=$_REQUEST['tipologia'];
$valor=$_REQUEST['valor'];
$idresidentes=$_REQUEST['idresidentes'];
$cuenta=$_REQUEST['cuenta'];
if($cuenta==1){
$tabla="colpatria";	
}
else if($cuenta==2){
$tabla="colombia";	
}
else{
$tabla="efectivo";	
}

mysqli_set_charset($con,"utf8");

$entrada=$valor;
$salida=0;	

$queryres="select idresidentes,documentor,nombresr,apellidosr from residentes 
where idresidentes='$idresidentes'";

$resultres1=mysqli_query($con,$queryres);
while ($resultrx = mysqli_fetch_array($resultres1)) {
$idres=$resultrx['idresidentes'];
$cedula=$resultrx['documentor'];
$nombres=$resultrx['nombresr'];
$apellidos=$resultrx['apellidosr'];
$detallec="Tienda de: ".$nombres." ".$apellidos;
}

$query2="INSERT INTO tienda(fecha,valorentrada,valorsalida,idclientes) 
VALUES('$fecha','$entrada','$salida','$idres')";

/*
echo "<br><br><br><br><br><br>";
echo $query2;
echo "<br><br>";
echo $idres;
*/

$result2=mysqli_query($conx,"$query2");

$query1="select acumulado from $tabla order by fecha DESC,id$tabla DESC LIMIT 1;";
$acum=0;
$result1=mysqli_query($con,"$query1");
while ($resultx = mysqli_fetch_array($result1)) {
$acum=$resultx['acumulado'];
}
$entrada=$valor;
$salida=0;	
$acumulado=($acum+$entrada-$salida);

$queryc2="INSERT INTO $tabla(fecha,concepto,valorentrada,valorsalida,acumulado) 
VALUES('$fecha','$detallec','$entrada','$salida','$acumulado')";
$resultc2=mysqli_query($con,"$queryc2");


if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='verlista.php?cod=$cedula'>Verificar saldo</a>";
	echo "<br><br>";
	echo "<a href='movimientos.php'>Buscar nuevo residente</a>";
	echo "</h1></center>";
}

include("footersadmin.html");
?>
</body>
</html>