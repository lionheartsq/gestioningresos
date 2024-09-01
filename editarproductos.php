<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");
$idproductos=$_REQUEST['idt'];

$query="select * from productos where idproductos='$idproductos'";
	
$result1=mysqli_query($conx,$query);

while ($resultx = mysqli_fetch_array($result1)) {
$plu=$resultx['plu'];
$detalle=$resultx['detalle'];
$unidades=$resultx['unidades'];
$valorcomprap=$resultx['valorcomprap'];
$pvp=$resultx['pvp'];
}
?>

<style>
.wrapper {
    text-align: center;
}
.btn{
	background-color:#941524;
	border-color:transparent;
	color:white;
	font-size:1.5em;
}
.btn:hover{
	background-color:#523a18;
	border-color:transparent;
	color:white;
}
</style>

<body>
  <div class="container"><br>
<div class="jumbotron">
<center><h2>Editar Producto</h2></center>
		<form id="crearprod" action = "editproductos.php" method = "post">
		
<div class="row ui-widget">	
<div class="col-md-3">
<label for="comercial">Nombre comercial</label><br>
<input type="text" id="comercial" name="comercial" class="form-control input-sm chat-input" 
value="<?php echo $detalle;?>"/>
</div>	
<div class="col-md-2">
<label for="unidades">Unidades</label>
<input type="number" id="unidades" name="unidades" class="form-control input-sm chat-input" 
value="<?php echo $unidades;?>"/>
</br>
</div>
<div class="col-md-2">
<label for="valorcompra">Compra paquete</label>
<input type="number" id="valorcompra" name="valorcompra" class="form-control input-sm chat-input" value="<?php echo $valorcomprap;?>"/>
</br>
</div>	
<div class="col-md-2">
<label for="pvp">Venta unidad</label>
<input type="number" id="pvp" name="pvp" class="form-control input-sm chat-input" value="<?php echo $pvp;?>"/>
</br>
</div>
<div class="col-md-3">
<label for="plu">PLU</label>
<input type="number" id="plu" name="plu" class="form-control input-sm chat-input" value="<?php echo $plu;?>"/>
</br>
</div>			
</div>
<input type="hidden" id="idproductos" name="idproductos" value="<?php echo "$idproductos";?>"> 
            <div class="wrapper">
			<button type="submit" class="btn btn-primary">Editar</button>          
            </div>
			</form>
</div>
</div>
<?php	
include("footersadmin.html");
?>
</body>
</html>