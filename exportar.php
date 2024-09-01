<?php
$fecha=date("y-m-d");
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=tienda20$fecha.xls");
?>
<html>

<div class="container">
<div class="jumbotron">

<h1>Listado de residentes</h1>

<?php
include_once('bas/conn.php');
include_once('bas/conx.php');
mysqli_set_charset($con,"utf8");

$queryu="select idresidentes,nombresr,apellidosr from residentes 
where estado in ('A','E')";	

$result1=mysqli_query($con,$queryu);

while ($resultax = mysqli_fetch_array($result1)) {
$nombres=$resultax['nombresr'];
$apellidos=$resultax['apellidosr'];
$idresi=$resultax['idresidentes'];
$nomresidente="$nombres"." "."$apellidos";
$total=0;
?>

<h2><?php echo $nomresidente; ?></h2>

<div class="table-responsive">
<table class="display" cellspacing="0" border="1" width="100%">

<thead>
    <tr>
<th><h2>Fecha</h2></th>
<th><h2>Entrada</h2></th>
<th><h2>Salida</h2></th>
<th><h2>Saldo</h2></th>
    </tr>
</thead>
<tbody>

<?php
$queryur="select fecha,valorentrada,valorsalida from tienda 
where idclientes='$idresi' order by fecha asc";		

$result1r=mysqli_query($conx,$queryur);

while ($resultxr = mysqli_fetch_array($result1r)) {
$fecha=$resultxr['fecha'];
$entradas=$resultxr['valorentrada'];
$salidas=$resultxr['valorsalida'];
$saldototal=$entradas-$salidas;
$total=$total+$saldototal;
?>
<tr>
<td><h3><?php echo $fecha; ?></h3></td>
<td><h3><?php echo $entradas; ?></h3></td>
<td><h3 style="color:red;"><?php echo $salidas; ?></h3></td>
<?php
if($total<0){
?>
<td><h3 style="color:red;"><?php echo $total; ?></h3></td>	
<?php	
}
else{
?>	
<td><h3><?php echo $total; ?></h3></td>	
<?php
}
?>
</tr>
<?php
}
?>
</tbody>

</table>
</div>
<?php
}
?>
</div>
</div>
</html>