<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");

$idpedidos=$_GET['id'];

mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 

//busco detalles de los pedidos basados en el id
$queryp="select fecha, documento, idproveedores from pedidos where idpedidos='$idpedidos'";	
$resultp=mysqli_query($conx,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$factura=$resultxp['documento'];
$fechafra=$resultxp['fecha'];
$idproveedores=$resultxp['idproveedores'];
}

//traigo datos del residente basados en la factura
$queryfl="select nombre from proveedores where idproveedores='$idproveedores'";	
$resultfl=mysqli_query($con,$queryfl);

while ($resultxfl = mysqli_fetch_array($resultfl)) {
$nombre=$resultxfl['nombre'];
$fullname="$nombre";
}
?>

<div class="container">
<div class="jumbotron">

<center>
<center><h2><?php echo "Proveedor : $fullname - Fecha : $fechafra - Factura : $factura"; ?></h2></center>
<hr style="background: red; height: 3px; width: 100%; border: 0">

<div class="table-responsive">
<table class="table table-striped table-bordered" width="100%">
<thead>
    <tr>
<th>Producto</th>
<th>Cant</th>
<th>Valor</th>
<th>Total</th>
    </tr>
</thead>
<tbody>
<?php
$acumfra=0;
//busco detalles de los pedidos basados en el producto
$queryp="select d.cantidad as cantidad, d.valor as valor, d.total as total, p.detalle as detalle 
from detallepedido d join productos p on d.idproductos=p.idproductos where d.idpedidos='$idpedidos'";	
$resultp=mysqli_query($conx,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$cantidad=$resultxp['cantidad'];
$valor=$resultxp['valor'];
$total=$resultxp['total'];
$producto=$resultxp['detalle'];

$acumfra=$acumfra+$total;

?>
<tr>
<td><?php echo "$producto"; ?></td>
<td><?php echo "$cantidad"; ?></td>
<td><?php echo "$valor"; ?></td>
<td><?php echo "$total"; ?></td>
</tr>
<?php
}
?>
</tbody>
</table>

	<div class="row ui-widget" style="background:cyan;">
			<div class="col-md-6">
			<b>Resumen pedido</b>	
			</div>	
			<div class="col-md-6">
			<b>Total: <?php echo $acumfra;?></b>			
			</div>		
	</div>
</div>
</center>
<br><br>

</div>
</div>
<?php
include("footersadmin.html");
?>
