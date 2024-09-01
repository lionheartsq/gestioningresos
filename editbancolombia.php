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
$observaciones=$_REQUEST['obs'];
$idcolpatria=$_REQUEST['idcolpatria'];

if($tipologia==1){
$entrada=$valor;
$salida=0;	
}
else if($tipologia==2){
$entrada=0;
$salida=$valor;
}

mysqli_set_charset($con,"utf8");

$query2="update colombia set fecha='$fecha',concepto='$observaciones',valorentrada='$entrada',valorsalida='$salida' where idcolombia='$idcolpatria'";
$result2=mysqli_query($con,"$query2");

$querya="select idcolombia from colombia;";
$resulta=mysqli_query($con,"$querya");
while ($resultax = mysqli_fetch_array($resulta)) {
$idtien=$resultax['idcolombia'];
if($idtien>1){
$querya1="update colombia set acumulado='0' where idcolombia='$idtien'";
$resulta1=mysqli_query($con,"$querya1");
}
}

$query1="select valorentrada,valorsalida,idcolombia from colombia order by fecha,idcolombia asc;";

$acum=0;
$result1=mysqli_query($con,"$query1");
while ($resultx = mysqli_fetch_array($result1)) {
$vent=$resultx['valorentrada'];
$vsal=$resultx['valorsalida'];
$idtie=$resultx['idcolombia'];
$acum=($acum+$vent-$vsal);
$query3="update colombia set acumulado='$acum' where idcolombia='$idtie'";
$result3=mysqli_query($con,"$query3");
}

if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='bancolombia.php'>Verificar saldo</a>";
	echo "<br><br>";
	echo "<a href='index.php'>Inicio</a>";
	echo "</h1></center>";
}

include("footersadmin.html");
?>
</body>
</html>