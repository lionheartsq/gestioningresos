<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conx.php');
include("menutienda.html");

$fecha=$_REQUEST['fecha'];
$tipologia=$_REQUEST['tipologia'];
$valor=$_REQUEST['valor'];
$idresidentes=$_REQUEST['idresidentes'];
$idtienda=$_REQUEST['idtienda'];

if($tipologia==1){
$entrada=$valor;
$salida=0;	
}
else if($tipologia==2){
$entrada=0;
$salida=$valor;
}

mysqli_set_charset($conx,"utf8");

$query2="update tienda set fecha='$fecha',valorentrada='$entrada',valorsalida='$salida' 
where idtienda='$idtienda'";
$result2=mysqli_query($conx,"$query2");

if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='verlista.php?cod=$idresidentes'>Verificar saldo</a>";
	echo "<br><br>";
	echo "<a href='index.php'>Buscar nuevo residente</a>";
	echo "</h1></center>";
}

include("footersadmin.html");
?>
</body>
</html>