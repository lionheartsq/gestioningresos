<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");

$idprod=$_GET['idresidentes'];

mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 

//traigo detalles del producto
$query="select * from productos where idproductos='$idprod'";
$result=mysqli_query($conx,$query);
while ($resultax = mysqli_fetch_array($result)) {
$plu=$resultax['plu'];
$detalle=$resultax['detalle'];
$nomprod=$plu." - ".$detalle;
$idproductos=$resultax['idproductos'];
}

$querytot="select sum(cantidad) as totalcantidad from detallefactura where idproductos='$idprod'";	
$resultot=mysqli_query($conx,$querytot);
while ($resultxtot = mysqli_fetch_array($resultot)) {
$totalcantidad=$resultxtot['totalcantidad'];
}

$querytotp="select sum(cantidad) as totalcantidad from detallepedido where idproductos='$idprod'";	
$resultotp=mysqli_query($conx,$querytotp);
while ($resultxtotp = mysqli_fetch_array($resultotp)) {
$totalcantidadp=$resultxtotp['totalcantidad'];
}

$inventario=$totalcantidadp-$totalcantidad;
?>

<div class="container">
<div class="jumbotron">

<center><h2><?php echo $nomprod; ?></h2></center>
<hr style="background: red; height: 3px; width: 100%; border: 0">
<center><h2><?php echo "Pedidos : $totalcantidadp - Facturas : $totalcantidad = Inventario : $inventario"; ?></h2></center>
<hr style="background: red; height: 3px; width: 100%; border: 0">

	<div class="row ui-widget">

			<div class="col-md-6">
<!--  Acá abro el div de los pedidos -->

	<div class="row ui-widget" style="background:yellow;">
			<div class="col-md-6">
			<b>Resumen pedidos</b>	
			</div>	
			<div class="col-md-6">
			<b>Total: <?php echo $totalcantidadp;?></b>			
			</div>		
	</div>

<center>
<div class="table-responsive">
<table class="table table-striped table-bordered" width="100%">
<thead>
    <tr>
<th>Fecha</th>
<th>Proveedor</th>
<th>Cant</th>
<th>Factura</th>
    </tr>
</thead>
<tbody>
<?php
$acumfrap=0;
//busco detalles de los pedidos basados en el producto
$querypp="select d.cantidad as cantidad, d.total as total, f.documento as factura, f.idpedidos as idped, f.fecha as fecha, f.idproveedores as idresidentes from detallepedido d join pedidos f on d.idpedidos=f.idpedidos where d.idproductos='$idprod' order by fecha desc";	
$resultpp=mysqli_query($conx,$querypp);
while ($resultxpp = mysqli_fetch_array($resultpp)) {
$cantidadp=$resultxpp['cantidad'];
$fechafrap=$resultxpp['fecha'];
$idfacturasp=$resultxpp['factura'];
$idped=$resultxpp['idped'];
$idresidentesp=$resultxpp['idresidentes'];

$acumfrap=$acumfrap+$cantidadp;

//traigo datos del proveedor basados en la factura
$queryflp="select nombre from proveedores where idproveedores='$idresidentesp'";	
$resultflp=mysqli_query($con,$queryflp);

while ($resultxflp = mysqli_fetch_array($resultflp)) {
$nombrep=$resultxflp['nombre'];
$fullnamep="$nombrep";
?>
<tr>
<td><?php echo "$fechafrap"; ?></td>
<td><?php echo "$fullnamep"; ?></td>
<td align="center"><?php echo "$cantidadp"; ?></td>
<td align="center">
<a href="javascript:window.open('pedido.php?id=<?php echo $idped; ?>','','width=1200,height=700,left=0,top=0,toolbar=no');void 0">
<?php echo "$idfacturasp"; ?></a>
</td>
</tr>
<?php
}
}
?>
</tbody>
</table>

	<div class="row ui-widget" style="background:yellow;">
			<div class="col-md-6">
			<b>Resumen pedidos</b>	
			</div>	
			<div class="col-md-6">
			<b>Total: <?php echo $acumfrap;?></b>			
			</div>		
	</div>
</div>
</center>
<!--  Acá cierro el div de los pedidos -->
			</div>

			<div class="col-md-6">

	<div class="row ui-widget" style="background:cyan;">
			<div class="col-md-6">
			<b>Resumen facturas</b>	
			</div>	
			<div class="col-md-6">
			<b>Total: <?php echo $totalcantidad;?></b>			
			</div>		
	</div>

<center>
<div class="table-responsive">
<table class="table table-striped table-bordered" width="100%">
<thead>
    <tr>
<th>Fecha</th>
<th>Cliente</th>
<th>Cant</th>
<th>Factura</th>
    </tr>
</thead>
<tbody>
<?php
$acumfra=0;
//busco detalles de las facturas basados en el producto
$queryp="select d.cantidad as cantidad, d.total as total, f.idfacturas as factura, f.fecha as fecha, f.idclientes as idresidentes 
from detallefactura d join facturas f on d.idfacturas=f.idfacturas where d.idproductos='$idprod' order by fecha desc";	
$resultp=mysqli_query($conx,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$cantidad=$resultxp['cantidad'];
$fechafra=$resultxp['fecha'];
$idfacturas=$resultxp['factura'];
$idresidentes=$resultxp['idresidentes'];

$acumfra=$acumfra+$cantidad;

//traigo datos del residente basados en la factura
$queryfl="select nombresr,apellidosr from residentes where idresidentes='$idresidentes'";	
$resultfl=mysqli_query($con,$queryfl);

while ($resultxfl = mysqli_fetch_array($resultfl)) {
$nombre=$resultxfl['nombresr'];
$apellido=$resultxfl['apellidosr'];
$fullname="$nombre $apellido";
?>
<tr>
<td><?php echo "$fechafra"; ?></td>
<td><?php echo "$fullname"; ?></td>
<td align="center"><?php echo "$cantidad"; ?></td>
<td align="center">
<a href="javascript:window.open('factura.php?id=<?php echo $idfacturas; ?>','','width=1200,height=700,left=0,top=0,toolbar=no');void 0">
<?php echo "$idfacturas"; ?></a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>

	<div class="row ui-widget" style="background:cyan;">
			<div class="col-md-6">
			<b>Resumen facturas</b>	
			</div>	
			<div class="col-md-6">
			<b>Total: <?php echo $acumfra;?></b>			
			</div>		
	</div>
</div>
</center>
			</div>
			
	</div>
<br><br>

</div>
</div>
<?php
include("footersadmin.html");
?>
