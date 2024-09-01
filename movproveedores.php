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
$idpedidos=$_REQUEST['idpedidos'];
$idproveedores=$_REQUEST['idproveedores'];

if($tipologia==1){
$tabla="colombia";	
}
else if($tipologia==2){
$tabla="colpatria";	
}
else{
$tabla="efectivo";	
}

mysqli_set_charset($con,"utf8");

//echo "<br>";
//echo $query1;
$query="select nombre from proveedores where idproveedores=$idproveedores;";
$result=mysqli_query($conx,$query);
while ($resultax = mysqli_fetch_array($result)) {
$nomprov=$resultax['nombre'];
}

$entrada=0;
$salida=$valor;
$query2="INSERT INTO pagos(fechaabono,valorpago,abono,idpedidos) 
VALUES('$fecha','$entrada','$salida','$idpedidos')";
$result2=mysqli_query($conx,"$query2");

$queryfr="select documento from pedidos where idpedidos=$idpedidos;";
$resultfr=mysqli_query($conx,$queryfr);
while ($resultaxfr = mysqli_fetch_array($resultfr)) {
$numfra=$resultaxfr['documento'];
}

$observacion=$nomprov." ".$numfra;

$queryc1="select acumulado from $tabla order by fecha DESC,id$tabla DESC LIMIT 1;";
$acumc=0;
$resultc1=mysqli_query($con,$queryc1);
while ($resultcx = mysqli_fetch_array($resultc1)) {
$acumc=$resultcx['acumulado'];
}
$entradac=0;
$salidac=$valor;

$acumuladoc=($acumc+$entradac-$salidac);
$queryc2="INSERT INTO $tabla(fecha,concepto,valorentrada,valorsalida,acumulado) 
VALUES('$fecha','$observacion','$entradac','$salidac','$acumuladoc')";
$resultc2=mysqli_query($con,"$queryc2");


if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='verlp.php?idresX=$idproveedores'>Verificar saldo</a>";
	echo "<br><br>";
	echo "<a href='pagos.php'>Buscar nuevo proveedor</a>";
	echo "</h1></center>";
}

include("footersadmin.html");
?>
</body>
</html>