<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");

$proveedor=$_REQUEST['resX'];
?>

<div class="container">
<div class="jumbotron">
<br><br><br>
<center>
<?php
mysqli_set_charset($con,"utf8");

$queryu="INSERT INTO proveedores(nombre,estado) VALUES('$proveedor','1')";
$result1=mysqli_query($con,$queryu);
if($result1){
	echo "<h1 style='color:white;'>Proveedor creado</h1>";
	echo "<br>";
	echo "<h1><a href='index.php'>Regresar al inicio</a></h1>";
}
else{
	echo "<h1 style='color:white;'>Proveedor no creado</h1>";
	echo "<br>";
	echo "<h1><a href='proveedor.php'>Intentar nuevamente</a></h1>";	
}
?>
</center>
</div>
</div>
<?php
include("footersadmin.html");
?>
