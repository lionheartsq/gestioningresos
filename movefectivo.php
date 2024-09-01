<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");

$fecha=$_REQUEST['fecha'];
$tipologia=$_REQUEST['tipologia'];
$valor=$_REQUEST['valor'];
$obs=$_REQUEST['obs'];

mysqli_set_charset($con,"utf8");

$query1="select acumulado from efectivorobert order by fecha DESC,idefectivorobert DESC LIMIT 1;";

$acum=0;
//echo "<br>";
//echo $query1;
$result1=mysqli_query($con,"$query1");
while ($resultx = mysqli_fetch_array($result1)) {
$acum=$resultx['acumulado'];
}
if($tipologia==1){
$entrada=$valor;
$salida=0;	
}
else if($tipologia==2){
$entrada=0;
$salida=$valor;
}
$acumulado=($acum+$entrada-$salida);
$query2="INSERT INTO efectivorobert(fecha,concepto,valorentrada,valorsalida,acumulado) 
VALUES('$fecha','$obs','$entrada','$salida','$acumulado')";

//echo "<br>";
//echo $query2;
$result2=mysqli_query($con,"$query2");

if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='efectivo.php'>Verificar saldo</a>";
	echo "<br><br>";
	echo "<a href='index.php'>Inicio</a>";
	echo "</h1></center>";
}

include("footersadmin.html");
?>
</body>
</html>