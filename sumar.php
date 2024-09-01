<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");

$aviso="";

if (isset($_GET['indicador'])){
		$flag=$_GET['indicador'];
		$idproductos=$_GET['idproductos'];
		$cantidad=$_GET['cantidad'];
		$precio=$_GET['precio'];
		$importe=($cantidad*$precio);
		$idfacturas=$_GET['idfacturas'];
		$idclientes=$_GET['idclientes'];
		$fechaf=$_GET['fechaf'];
		$nombre=$_GET['nombre'];
		$saldo=$_GET['saldo'];

		$sqlxr="UPDATE detallefactura SET cantidad='$cantidad',valor='$precio',
		total='$importe' WHERE iddetallefactura='$flag'";
		$resultxr = mysqli_query($conx,$sqlxr);
	}
	else{
		$idfacturas=$_POST['idfacturas'];
		$idclientes=$_POST['idclientes'];
		$fechaf=$_POST['fechaf'];
		$nombre=$_POST['nombre'];
		$plu=$_POST['plu'];
		$saldo=$_POST['saldo'];
		
		$queryur="select * from productos where plu='$plu' and estado='1'";	

$resultcount=mysqli_query($conx,$queryur);
$row_cnt = mysqli_num_rows($resultcount);
if($row_cnt>0){		
		$result1r=mysqli_query($conx,$queryur);
		while ($resultxr = mysqli_fetch_array($result1r)) {
		$idproductos=$resultxr['idproductos'];
		$pvp=$resultxr['pvp'];
		}

		$sql="INSERT INTO detallefactura(idproductos,cantidad,valor,total,idfacturas) 
		VALUES ('$idproductos','1','$pvp','$pvp','$idfacturas')";	

		//echo $queryur;
		$result = mysqli_query($conx,"$sql");
		$rs = mysqli_query($conx,"SELECT @@identity AS id");
			if ($row = mysqli_fetch_row($rs)) {
				$idcl = trim($row[0]);
			}
}
else {
	$aviso="El producto con plu: $plu no existe, primero debe crearlo";
}	
}
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