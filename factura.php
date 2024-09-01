<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");

$idfacturas=$_GET['id'];

mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 

//busco detalles de las facturas basados en el producto
$queryp="select fecha, idclientes from facturas f where idfacturas='$idfacturas'";	
$resultp=mysqli_query($conx,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$fechafra=$resultxp['fecha'];
$idclientes=$resultxp['idclientes'];
}

//traigo datos del residente basados en la factura
$queryfl="select nombresr, apellidosr from residentes where idresidentes='$idclientes'";	
$resultfl=mysqli_query($con,$queryfl);

while ($resultxfl = mysqli_fetch_array($resultfl)) {
$nombre=$resultxfl['nombresr'];
$apellido=$resultxfl['apellidosr'];
$fullname="$nombre $apellido";
}
?>

<div class="container">
<div class="jumbotron">

<center>
<center><h2><?php echo"Factura: $idfacturas - Fecha: $fechafra - Residente: $fullname"; ?></h2></center>
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
//busco detalles de las facturas basados en el producto
$queryp="select p.detalle as detalle, d.cantidad as cantidad, d.valor as valor, d.total as total from detallefactura d 
join productos p on d.idproductos=p.idproductos where d.idfacturas='$idfacturas'";	
$resultp=mysqli_query($conx,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$detalle=$resultxp['detalle'];
$cantidad=$resultxp['cantidad'];
$valor=$resultxp['valor'];
$total=$resultxp['total'];

$acumfra=$acumfra+$total;

?>
<tr>
<td><?php echo "$detalle"; ?></td>
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
			<b>Resumen factura</b>	
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
