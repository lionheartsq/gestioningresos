<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conx.php');
include_once('bas/conn.php');
include("menutienda.html");
mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 

$fechai=$_REQUEST['fechai'];
$fechaf=$_REQUEST['fechaf'];
$idclientes=$_REQUEST['idclientes'];

$search1="select * from residentes where idresidentes='$idclientes'";
$resulta1 = mysqli_query($con,"$search1");

while ($resultx1 = mysqli_fetch_array($resulta1)) {
$nombres=$resultx1['nombresr'];
$apellidos=$resultx1['apellidosr'];
$nomprov=$nombres." ".$apellidos;
}

$query="select * from facturas where total>0 and fecha between '$fechai' and '$fechaf'";

if($idclientes!=0){
$query = $query." and idclientes= ".$idclientes;	
}

$query = $query." order by fecha DESC";	
?>

<div class="container">
<div class="jumbotron">
<?php
//echo $query;
$result=mysqli_query($conx,$query);

while ($resultax = mysqli_fetch_array($result)) {
?>
<center><h2><?php echo $nomprov; ?></h2></center>
<hr style="background: red; height: 3px; width: 100%; border: 0">
<?php
$fechafra=$resultax['fecha'];
$valorfra=$resultax['total'];
$idventa=$resultax['idfacturas'];
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
$queryfl="select * from detallefactura d join productos p on d.idproductos=p.idproductos where d.iddetallefactura='$idventa'";	
$resultfl=mysqli_query($conx,$queryfl);

while ($resultxfl = mysqli_fetch_array($resultfl)) {
$producto=$resultxfl['detalle'];
$cantidad=$resultxfl['cantidad'];
$valorpago=$resultxfl['valor'];
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
?>
</div>
</div>
<?php
include("footersadmin.html");
?>
