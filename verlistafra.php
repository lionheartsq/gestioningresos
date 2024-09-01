<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");

$idresidentes=$_GET['idresidentes'];

mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 
?>

<div class="container">
<div class="jumbotron">

<?php
$query="select * from residentes where idresidentes='$idresidentes'";
$result=mysqli_query($con,$query);
while ($resultax = mysqli_fetch_array($result)) {
$nompv=$resultax['nombresr'];
$apv=$resultax['apellidosr'];
$nomprov=$nompv." ".$apv;
$idresidentes=$resultax['idresidentes'];
?>
<center><h2><?php echo $nomprov; ?></h2></center>
<hr style="background: red; height: 3px; width: 100%; border: 0">
<?php
$queryp="select * from facturas where idclientes='$idresidentes' order by fecha desc";	
$resultp=mysqli_query($conx,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$fechafra=$resultxp['fecha'];
$valorfra=$resultxp['total'];
$idventa=$resultxp['idfacturas'];
//new
$acumpagofl=0;
?>
<center><h2><?php echo "Fecha Venta: - ".$fechafra; ?></h2></center><br>
<center>
<div class="table-responsive">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Producto</th>
<th>Cantidad</th>
<th>Valor</th>
    </tr>
</thead>
<tbody>
<?php
$queryfl="select * from detallefactura d join productos p on d.idproductos=p.idproductos where idfacturas='$idventa'";	
$resultfl=mysqli_query($conx,$queryfl);

while ($resultxfl = mysqli_fetch_array($resultfl)) {
$producto=$resultxfl['detalle'];
$cantidad=$resultxfl['cantidad'];
$valorpago=$resultxfl['total'];
$acumpagofl=$acumpagofl+$valorpago;
?>
<tr>
<td><?php echo "$producto"; ?></td>
<td><?php echo "$cantidad"; ?></td>
<td style="color:green;"><?php echo "$valorpago"; ?></td>
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
			<b>Total: <?php echo $acumpagofl;?></b>			
			</div>		
	</div>
</div>
</center>
<br><br>
<?php
}
}
?>
</div>
</div>
<?php
include("footersadmin.html");
?>
