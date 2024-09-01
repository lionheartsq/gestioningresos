<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
include_once('bas/conn.php');
mysqli_set_charset($conx,"utf8");

$idfact=$_GET['idpedidos'];

$searchp="select * from pedidos where idpedidos='$idfact'";
$resultap = mysqli_query($conx,"$searchp");

while ($resultxp = mysqli_fetch_array($resultap)) {
$proveedor=$resultxp['idproveedores'];
$fecha=$resultxp['fecha'];
$total=$resultxp['total'];
}

$search1="select * from proveedores where idproveedores='$proveedor'";
$resulta1 = mysqli_query($con,"$search1");

while ($resultx1 = mysqli_fetch_array($resulta1)) {
$razonsocial=$resultx1['nombre'];
}
?>
<body>
<div class="container"> 
<div class="jumbotron">
<?php
//echo $sql2;

$search="select * from pedidos where idpedidos='$idfact'";
$resulta = mysqli_query($conx,"$search");

while ($resultx = mysqli_fetch_array($resulta)) {
$nidpedidos=$resultx['idpedidos'];
$nfecha=$resultx['fecha'];
$nfactura=$resultx['documento'];
$nvalor=$resultx['total'];
$idproveedores=$resultx['idproveedores'];
}
?>
<div class="row">
			<div class="col-md-4">
			<h2>Fecha : <?php echo "$nfecha";?></h2>
            <br>			
			</div>
			<div class="col-md-4">
			<h2>Factura # <?php echo "$nfactura";?></h2>
            <br>			
			</div>
			<div class="col-md-4"><br>
            Proveedor: <?php echo "$razonsocial<br>";?>
            <br>
			</div>		
</div>
<p>	
<div class="row">
			<form id="sumar" action = "sumarp.php" method = "post" >
			
			<div class="col-md-2">
			<label for="cantidadp">Cantidad</label>
			<input type="number" step="0.01" min="0" id="cantidad" name="cantidad" class="form-control input-sm chat-input"  value="" required/>
            <br>
			</div>
			
			<div class="col-md-6">
            <label for="plu">PLU : </label><input type="text" id="plu" name="plu" class="form-control input-sm chat-input" required/>			
			</div>

            <input type="hidden" id="idpedidos" name="idpedidos" value="<?php echo "$idfact";?>">  
            <input type="hidden" id="idproveedores" name="idproveedores" value="<?php echo "$idproveedores";?>">  
            <input type="hidden" id="fechaf" name="fechaf" value="<?php echo "$fecha";?>">  
            <input type="hidden" id="nombre" name="nombre" value="<?php echo "$razonsocial";?>">  
			<input type="hidden" id="factura" name="factura" value="<?php echo "$nfactura";?>">  
            <input type="hidden" id="saldo" name="saldo" value="<?php echo "$total";?>">  
            
            <div class="col-md-2"><br>
                <button type="submit" class="btn btn-primary">Añadir</button>
            </div>			
			</form>	
</div>
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
from detallepedido d join productos p on d.idproductos=p.idproductos where d.idpedidos='$nidpedidos' 
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
<td><input type="number" id="saldo" name="saldo" class="form-control input-sm chat-input" value="<?php echo $importex;?>"/></td><!--Cantidad-->

<input type="hidden" id="indicador" name="indicador" value="<?php echo "$indicador";?>">

            <input type="hidden" id="idpedidos" name="idpedidos" value="<?php echo "$idfact";?>">  
            <input type="hidden" id="idproveedores" name="idproveedores" value="<?php echo "$idproveedores";?>">  
            <input type="hidden" id="fechaf" name="fechaf" value="<?php echo "$fecha";?>">  
            <input type="hidden" id="nombre" name="nombre" value="<?php echo "$razonsocial";?>">  
			<input type="hidden" id="factura" name="factura" value="<?php echo "$nfactura";?>">  
            <input type="hidden" id="saldo" name="saldo" value="<?php echo "$total";?>">  	
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
			<?php $url="cerrarp.php?idproyectos=$idfact&totalimportecl=$totalimport&factura=$nfactura";?>
			<a href="<?php echo $url;?>"><button type="button" class="btn btn-danger">Finalizar</button></a>
			</div>			
	</div>

</div>
</div>

<?php	
include("footersadmin.html");
?>
</body>
</html>