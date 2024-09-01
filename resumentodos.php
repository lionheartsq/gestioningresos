<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");
mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 
?>

<div class="container">
<div class="jumbotron">

<?php
$query="select * from proveedores";
$result=mysqli_query($con,$query);
while ($resultax = mysqli_fetch_array($result)) {
$nomprov=$resultax['nombre'];
$idproveedores=$resultax['idproveedores'];
?>
<center><h2><?php echo $nomprov; ?></h2></center>
<hr style="background: red; height: 3px; width: 100%; border: 0">
<?php
$queryp="select * from pedidos where idproveedores='$idproveedores' order by fecha asc";	
$resultp=mysqli_query($conx,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$fechafra=$resultxp['fecha'];
$fra=$resultxp['documento'];
$valorfra=$resultxp['total'];
$idpedidos=$resultxp['idpedidos'];
//new
$acumpagofl=0;
$acumabfl=0;

$queryfl="select * from pagos where idpedidos='$idpedidos' order by fechaabono asc";	
$resultfl=mysqli_query($conx,$queryfl);

while ($resultxfl = mysqli_fetch_array($resultfl)) {
$abonofl=$resultxfl['abono'];
$valorpagofl=$resultxfl['valorpago'];
$acumpagofl=$acumpagofl+$valorpagofl;
$acumabfl=$acumabfl+$abonofl;
$saldofl=$acumpagofl-$acumabfl;
}
?>
<center><h2><?php echo "Movimientos factura: ".$fra; ?></h2></center><br>
<center>
<div class="table-responsive">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Idpedidos</th>
<th>Idpagos</th>
<th>Fecha</th>
<th>Valor fra</th>
<th>Abono fra</th>
<th>Saldo</th>
    </tr>
</thead>
<tbody>

<?php
$queryu="select * from pagos where idpedidos='$idpedidos' order by fechaabono asc";	
$result1=mysqli_query($conx,$queryu);
$acumab=0;

while ($resultx = mysqli_fetch_array($result1)) {
$idpx=$resultx['idpagos'];
$fechaabono=$resultx['fechaabono'];
$abono=$resultx['abono'];
$acumab=$acumab+$abono;
$saldo=$valorfra-$acumab;
?>
<tr>
<td><?php echo "$idpedidos"; ?></td>
<td><?php echo "$idpx"; ?></td>
<td><?php echo "$fechaabono"; ?></td>
<td><?php echo "$valorfra"; ?></td>
<td style="color:green;"><?php echo "$abono"; ?></td>
<td style="color:red;"><?php echo "$saldo"; ?></td>	
</tr>
<?php
}
?>
</tbody>
</table>
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
