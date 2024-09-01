<?php 
include_once('bas/conn.php');
include_once('bas/conx.php');
?>

<html>
<head>
<script>
function imprimir(){
  window.print();
}
</script>
<style>
@media print{
  .oculto-impresion, .oculto-impresion *{
    display: none !important;
  }
}
</style>
<center>
<h2>Saldos por residente Fecha: <?php
        date_default_timezone_set('UTC');
        echo date("Y-m-d");
?><h2></center>
</head>
<body>

<center><br><form>
<button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
</form></center>


<?php
mysqli_set_charset($con,"utf8");
?>

<center><h2>Listado de residentes</h2>
<table id="tabla" border="1" cellspacing="0" width="80%">

<thead>
    <tr>
<th>Residente</th>
<th>Saldo</th>
<th>Tienda dia</th>
    </tr>
</thead>	

<tbody>

<?php
mysqli_set_charset($con,"utf8");
$queryu="select distinct idresidentes,nombresr,apellidosr from residentes where residentes.estado='A' or residentes.estado='E' order by nombresr,apellidosr asc";	

$result1=mysqli_query($con,$queryu);

$total=0;

while ($resultax = mysqli_fetch_array($result1)) {
$nombres=$resultax['nombresr'];
$apellidos=$resultax['apellidosr'];
$idresi=$resultax['idresidentes'];
$nomresidente="$nombres"." "."$apellidos";

$queryur="select SUM(tienda.valorentrada) as valorentrada,
sum(tienda.valorsalida) as valorsalida from tienda where idclientes=$idresi;";	

$result1r=mysqli_query($conx,$queryur);

while ($resultxr = mysqli_fetch_array($result1r)) {
$entradas=$resultxr['valorentrada'];
$salidas=$resultxr['valorsalida'];
}

$saldototal=$entradas-$salidas;
if($saldototal != 0){
?>
<tr>
<td><?php echo $nomresidente; ?></td>
<td><?php echo $saldototal; ?></td>
<th></th>
</tr>
<?php
}
}
?>
</tbody>

</table>
</center>
</body>
</html>