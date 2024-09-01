<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");

$aviso="";
		$fecha=$_GET['fecha'];
		$nombre=$_GET['residente'];
		$idfacturas=$_GET['factura'];
		$idclientes=$_GET['idresidentes'];
		$valfactura=$_GET['total'];
		
$quyur="select SUM(valorentrada) as valorentrada,sum(valorsalida) as valorsalida 
from tienda where idclientes='$idclientes'";	

$resr=mysqli_query($conx,$quyur);
while ($resxr = mysqli_fetch_array($resr)) {
$entradas=$resxr['valorentrada'];
$salidas=$resxr['valorsalida'];
}
$saldo=$entradas-$salidas;
		
?>
<body>
  <div class="container"> 
<div class="jumbotron">

		<div class="row">
			<div class="col-md-4"><br>
            Cliente: <?php echo "$nombre";?><br>
            Saldo Inicial: <?php echo "$saldo";?>
            <br>
			</div>		

			<form id="sumar" action = "sumar.php" method = "post" >
			

			<div class="col-md-6">
			<body onload="document.getElementById('plu').focus()">
            <label for="plu">PLU : </label><input type="text" id="plu" name="plu" class="form-control input-sm chat-input" autofocus required/>			
			</div>

            <input type="hidden" id="idfacturas" name="idfacturas" value="<?php echo "$idfacturas";?>">  
            <input type="hidden" id="idclientes" name="idclientes" value="<?php echo "$idclientes";?>">  
            <input type="hidden" id="fechaf" name="fechaf" value="<?php echo "$fechaf";?>">  
            <input type="hidden" id="nombre" name="nombre" value="<?php echo "$nombre";?>">  
			<input type="hidden" id="saldo" name="saldo" value="<?php echo "$saldo";?>">
			<div class="col-md-2"><br>
			<button type="submit" class="btn btn-primary">Añadir</button>          
            </div>		
		</div>		
			</form>	
<?php
echo "<b style='color:red;'>$aviso</b>";
?>
</p>

<hr>

<div class="table-responsive" style="background:white;" id="suma">
<p>&nbsp;Productos añadidos</p>
<table class="display" cellspacing="0" width="100%">
<thead>
<tr>
<th>Producto</th>	
<th>Cant</th>
<th>Precio</th>
<th>Total</th>
<th>Editar</th>
</tr>
</thead>
<tbody>
<?php
$totales="select d.idproductos as idpr,p.detalle as descripcionx,d.valor as preciox, 
d.cantidad as medicionx,d.total as importex,d.iddetallefactura as indicador, 
d.idfacturas as idfra from detallefactura d join productos p 
on d.idproductos=p.idproductos where d.idfacturas='$idfacturas' order by iddetallefactura desc";

//echo $totales;

$totalimport=0;

$resultax = mysqli_query($conx,$totales);

while ($resultxs = mysqli_fetch_array($resultax)) {
	$idpr=$resultxs['idpr'];
	$idfra=$resultxs['idfra'];
	$actividadx=$resultxs['descripcionx'];
	$preciox=$resultxs['preciox'];
	$udsx=$resultxs['medicionx'];
	$importex=$resultxs['importex'];
	$indicador=$resultxs['indicador'];
	?>
	<form id="sumar2" action = "sumar.php" method = "get" >
	<tr>
	<td>
	<input type="text" class="form-control input-sm chat-input" value="<?php echo $actividadx;?>" readonly/>
	</td><!--Detalle-->
	<td><input type="number" id="cantidad" name="cantidad" class="form-control input-sm chat-input" value="<?php echo $udsx;?>"/></td><!--Cantidad-->
	<td><input type="number" id="precio" name="precio" class="form-control input-sm chat-input" value="<?php echo $preciox;?>"/></td><!--Precio-->
	<td><input type="number" id="importe" name="importe" class="form-control input-sm chat-input" value="<?php echo $importex;?>" readonly/></td><!--Cantidad-->
	<input type="hidden" id="indicador" name="indicador" value="<?php echo "$indicador";?>">
	<input type="hidden" id="idfacturas" name="idfacturas" value="<?php echo "$idfra";?>">
	<input type="hidden" id="idproductos" name="idproductos" value="<?php echo "$idpr";?>">
    <input type="hidden" id="idclientes" name="idclientes" value="<?php echo "$idclientes";?>">  	
    <input type="hidden" id="fechaf" name="fechaf" value="<?php echo "$fechaf";?>">  
    <input type="hidden" id="nombre" name="nombre" value="<?php echo "$nombre";?>">  	
    <input type="hidden" id="saldo" name="saldo" value="<?php echo "$saldo";?>">
	<td><button type="submit" class="btn btn-danger">Editar</button></td>          
	</tr>			
	</form>
	<?php
	$totalimport=$totalimport+$importex;
	$saldon=($saldo-$totalimport);
}//fin for
?>
</tbody>
</table>
</div>
<hr>
	<div class="row ui-widget" style="background:cyan;">
			<div class="col-md-5">
			<b>Total factura: <?php echo $totalimport;?></b>			
			</div>
			<div class="col-md-4">
			<b>Nuevo saldo: <?php echo $saldon;?></b>	
			</div>	
			<div class="col-md-3">
			<?php $url="cerrar.php?idfacturas=$idfacturas&totalimporte=$totalimport&idclientes=$idclientes&tipopago=3";?>
			<a href="<?php echo $url;?>"><button type="button" class="btn btn-danger">Finalizar</button></a>
			</div>			
	</div>

</div>
</div>

</body>

<?php	
include("footersadmin.html");
?>
</body>
</html>