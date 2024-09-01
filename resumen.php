<?php
include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");
?>
<div class="container">
<div class="jumbotron">
<center>
<?php
mysqli_set_charset($con,"utf8");
?>

<center><a href="exportar.php">Exportar a excel</a></center><br>

<center><h1>Listado de residentes</h1></center>

<?php
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
<table cellspacing="0" border="1" width="100%">

<thead>
    <tr>
<th><h3>Fecha</h3></th>
<th><h3>Entrada</h3></th>
<th><h3>Salida</h3></th>
<th><h3>Saldo</h3></th>
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

</table>
</div>
<?php
}
?>
<br><center><a href="exportar.php">Exportar a excel</a></center>
</center>
<br>

</div>
</div>
<?php
include("footersadmin.html");
?>
