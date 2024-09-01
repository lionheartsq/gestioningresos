<!DOCTYPE html>
<html lang="es">

<?php
$fecha = date("y-m-d");
$hoy="20$fecha";

include("menutienda.html");
include_once('bas/conx.php');
include_once('bas/conn.php');
mysqli_set_charset($conx,"utf8");

$idpedidos=$_GET['idpedidos'];

?>
<body>
  <div class="container"> 
<div class="jumbotron">
<?php

$search="select * from pedidos where idpedidos='$idpedidos'";
$resulta = mysqli_query($conx,"$search");

if($resulta){
//estoy sacando los datos de los pedidos para mostrar
while ($resultx = mysqli_fetch_array($resulta)) {
$idproveedores=$resultx['idproveedores'];
$documento=$resultx['documento'];
$fecha=$resultx['fecha'];
$valor=$resultx['total'];

$search1="select * from proveedores where idproveedores='$idproveedores'";
$resulta1 = mysqli_query($con,"$search1");

if($resulta1){
while ($resultx1 = mysqli_fetch_array($resulta1)) {
$razonsocial=$resultx1['nombre'];
}
}

?>
<div class="row">
			<div class="col-md-3">
			<h2>Factura # <?php echo "$documento";?></h2>	
			</div>
			<div class="col-md-4">
            <b>Proveedor: <?php echo "$razonsocial";?></b>
            <br>
			</div>		
			<div class="col-md-3">
			<b>Resumen factura</b>	
			</div>	
			<div class="col-md-2">
			<b>Total: <?php echo $valor;?></b>			
			</div>	
</div>
<hr>
<div class="row">
			<div class="col-md-12">
            <h2><a href="pedidos.php">Nuevo Pedido</a></h2>
            <br>
			</div>		
</div>
<?php
}
}else{
?>	
<p>Error en la base de datos.</p>
<?php	
}
?>

</div>
</div>

</body>

<?php	
include("footersadmin.html");
?>
</body>
</html>