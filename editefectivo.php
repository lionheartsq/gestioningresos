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
$idefectivorobert=$_REQUEST['idefectivorobert'];

if($tipologia==1){
$entrada=$valor;
$salida=0;	
}
else if($tipologia==2){
$entrada=0;
$salida=$valor;
}

mysqli_set_charset($con,"utf8");

$query2="update efectivorobert set fecha='$fecha',concepto='$observaciones',valorentrada='$entrada',valorsalida='$salida' where idefectivorobert='$idefectivorobert'";
$result2=mysqli_query($con,"$query2");

$querya="select idefectivorobert from efectivorobert;";
$resulta=mysqli_query($con,"$querya");
while ($resultax = mysqli_fetch_array($resulta)) {
$idtien=$resultax['idefectivorobert'];
if($idtien>1){
$querya1="update efectivorobert set acumulado='0' where idefectivorobert='$idtien'";
$resulta1=mysqli_query($con,"$querya1");
}
}

$query1="select valorentrada,valorsalida,idefectivorobert from efectivorobert order by fecha,idefectivorobert asc;";

$acum=0;
$result1=mysqli_query($con,"$query1");
while ($resultx = mysqli_fetch_array($result1)) {
$vent=$resultx['valorentrada'];
$vsal=$resultx['valorsalida'];
$idtie=$resultx['idefectivorobert'];
$acum=($acum+$vent-$vsal);
$query3="update efectivorobert set acumulado='$acum' where idefectivorobert='$idtie'";
$result3=mysqli_query($con,"$query3");
}

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