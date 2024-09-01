<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
include_once('bas/conn.php');
mysqli_set_charset($conx,"utf8");

$aviso="";

if (isset($_GET['indicador'])){
		$flag=$_GET['indicador'];
		$idproductos=$_GET['idproductos'];
		$cantidad=$_GET['cantidad'];
		$precio=$_GET['precio'];
		$importe=($cantidad*$precio);
		$idpedidos=$_GET['idpedidos'];
		$idproveedores=$_GET['idproveedores'];
		$fechaf=$_GET['fechaf'];
		$nombre=$_GET['nombre'];
		$saldo=$_GET['saldo'];
		$nfactura=$_GET['factura'];

		$sqlxr="UPDATE detallepedido SET idproductos='$idproductos',cantidad='$cantidad',valor='$precio',total='$importe',idpedidos='$idpedidos' 
		WHERE iddetallepedido='$flag'";
		
$resultxr = mysqli_query($conx,$sqlxr);
}
else{
$plu=$_POST['plu'];
$cantidad=$_POST['cantidad'];
$idpedidos=$_POST['idpedidos'];
$idproveedores=$_POST['idproveedores'];
$fechaf=$_POST['fechaf'];
$nombre=$_POST['nombre'];
$saldo=$_POST['saldo'];
$nfactura=$_POST['factura'];

		$queryur="select * from productos where plu='$plu' and estado='1'";	

$resultcount=mysqli_query($conx,$queryur);
$row_cnt = mysqli_num_rows($resultcount);
if($row_cnt>0){
		$result1r=mysqli_query($conx,$queryur);
		while ($resultxr = mysqli_fetch_array($result1r)) {
		$idproductos=$resultxr['idproductos'];
		$valorcompra=$resultxr['valorcompra'];
		}

$importe=$cantidad*$valorcompra;
		
$sql="INSERT INTO detallepedido(idproductos,cantidad,valor,total,idpedidos) 
VALUES ('$idproductos','$cantidad','$valorcompra','$importe','$idpedidos')";	

$result = mysqli_query($conx,"$sql");
$rs = mysqli_query($con,"SELECT @@identity AS id");
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
			<div class="col-md-3">
			<h2>Fecha : <?php echo "$fechaf";?></h2>
            <br>			
			</div>
			<div class="col-md-5">
			<h2>Factura # <?php echo "$nfactura";?></h2>
            <br>			
			</div>
			<div class="col-md-4"><br>
            Proveedor: <?php echo "$nombre<br>";?>
            <br>
			</div>		
</div>
<?php
echo "<b style='color:red;'>$aviso</b>";
?>
<p>	
			<form id="sumar" action = "sumarp.php" method = "post" >
<div class="row">			
			<div class="col-md-2">
			<label for="cantidad">Cantidad</label>
			<input type="number" step="0.01" min="0" id="cantidad" name="cantidad" class="form-control input-sm chat-input"  value="" required/>
            <br>
			</div>
			
			<div class="col-md-6">
            <label for="plu">PLU : </label><input type="text" id="plu" name="plu" class="form-control input-sm chat-input" autofocus required/>			
			</div>

            <input type="hidden" id="idpedidos" name="idpedidos" value="<?php echo "$idpedidos";?>">  
            <input type="hidden" id="idproveedores" name="idproveedores" value="<?php echo "$idproveedores";?>">  
            <input type="hidden" id="fechaf" name="fechaf" value="<?php echo "$fechaf";?>">  
            <input type="hidden" id="nombre" name="nombre" value="<?php echo "$nombre";?>">  
			<input type="hidden" id="factura" name="factura" value="<?php echo "$nfactura";?>">  
           <input type="hidden" id="saldo" name="saldo" value="<?php echo "$total";?>">			
			<div class="col-md-2"><br>
			<button type="submit" class="btn btn-primary">Añadir</button>          
            </div>			
</div>
			</form>	
</p>
<hr>

<div class="table-responsive" style="background:white;">
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
$totales="select p.idproductos as idpr, p.detalle as actividadx,p.valorcompra as preciox,d.cantidad as medicionx,
d.total as importeclientex,d.iddetallepedido as indicador,d.idpedidos as idfra 
from detallepedido d join productos p on d.idproductos=p.idproductos where d.idpedidos='$idpedidos' 
order by d.iddetallepedido desc";

//echo $totales;

$totalimport=0;

$resultax = mysqli_query($conx,$totales);

while ($resultxs = mysqli_fetch_array($resultax)) {
$idpr=$resultxs['idpr']; //idproductos
$idfra=$resultxs['idfra']; //idpedidos
$actividadx=$resultxs['actividadx']; //detalle
$udsx=$resultxs['medicionx']; //cantidad
$preciox=$resultxs['preciox']; //valor
$importex=$resultxs['importeclientex']; //total
$indicador=$resultxs['indicador']; //iddetallepedido
?>
<form id="sumar2" action = "sumarp.php" method = "get" >
<tr>
<td>
<input type="text" class="form-control input-sm chat-input" value="<?php echo $actividadx;?>" readonly/>
</td><!--Detalle-->
<td><input type="number" id="cantidad" name="cantidad" class="form-control input-sm chat-input" value="<?php echo $udsx;?>"/></td><!--Cantidad-->
<td><input type="number" id="precio" name="precio" class="form-control input-sm chat-input" value="<?php echo $preciox;?>"/></td><!--Precio-->
<td><input type="number" id="saldo" name="saldo" class="form-control input-sm chat-input" value="<?php echo $importex;?>" readonly/></td><!--Cantidad-->

<input type="hidden" id="indicador" name="indicador" value="<?php echo "$indicador";?>">
            <input type="hidden" id="idpedidos" name="idpedidos" value="<?php echo "$idfra";?>">  
            <input type="hidden" id="idproveedores" name="idproveedores" value="<?php echo "$idproveedores";?>">  
            <input type="hidden" id="fechaf" name="fechaf" value="<?php echo "$fechaf";?>">  
            <input type="hidden" id="nombre" name="nombre" value="<?php echo "$nombre";?>">  
			<input type="hidden" id="factura" name="factura" value="<?php echo "$nfactura";?>">  
            <input type="hidden" id="idproductos" name="idproductos" value="<?php echo "$idpr";?>">  
<td><button type="submit" class="btn btn-danger">Editar</button></td>    
</tr>			
</form>
<?php	
$totalimport=$totalimport+$importex;
}//fin for
?>
</tbody>
</table>
</div>
<hr>
	<div class="row ui-widget" style="background:cyan;">
			<div class="col-md-4">
			<b>Resumen pedido</b>	
			</div>	
			<div class="col-md-3">
			<b>Total: <?php echo $totalimport;?></b>			
			</div>	
			<div class="col-md-2">
			<?php $url="cerrarp.php?idproyectos=$idpedidos&totalimportecl=$totalimport&factura=$nfactura";?>
			<a href="<?php echo $url;?>"><button type="button" class="btn btn-danger">Finalizar</button></a>
			</div>			
	</div>

</div>
</div>

<script type="text/javascript">
$(document).ready(function() {	
    $('#plu').on('blur', function() {
        $('#result-username').html('<img src="images/loader.gif" />').fadeOut(100);
 
        var plu = $(this).val();		
        var dataString = 'username='+username;
 
        $.ajax({
            type: "POST",
            url: "prodx.php",
            data: dataString,
            success: function(data) {
                $('#result-username').fadeIn(100).html(data);
            }
        });
    });              
});    
</script>		<!-- boots -->


<?php	
include("footersadmin.html");
?>
</body>
</html>