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
$idpagos=$_REQUEST['idpagos'];

if($tipologia==1){
$entrada=$valor;
$salida=0;	
}
else if($tipologia==2){
$entrada=0;
$salida=$valor;
}

mysqli_set_charset($conx,"utf8");

$querys="select * from pagos where idpagos='$idpagos'";
$results2=mysqli_query($conx,"$querys");
while ($resultsx = mysqli_fetch_array($results2)) {
$idpedidos=$resultsx['idpedidos'];

$querys1="select * from pedidos where idpedidos='$idpedidos'";
$results1=mysqli_query($conx,"$querys1");
while ($resultsx1 = mysqli_fetch_array($results1)) {
$idproveedores=$resultsx1['idproveedores'];
}

}

$query2="update pagos set fechaabono='$fecha',valorpago='$entrada',abono='$salida' where idpagos='$idpagos'";
$result2=mysqli_query($conx,"$query2");

if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='verlistap.php?idresX=$idproveedores'>Verificar saldo</a>";
	echo "<br><br>";
	echo "<a href='index.php'>Inicio</a>";
	echo "</h1></center>";
}

include("footersadmin.html");
?>
</body>
</html>