<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");
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
<center><h2>Producto Nuevo</h2></center>
		<form id="crearprod" action = "crearprod.php" method = "post">
		
<div class="row ui-widget">	
<div class="col-md-3">
<label for="comercial">Nombre comercial</label><br>
<input type="text" id="comercial" name="comercial" class="form-control input-sm chat-input" placeholder="Nombre comercial" required/>
</div>	
<div class="col-md-2">
<label for="unidades">Unidades</label>
<input type="number" id="unidades" name="unidades" class="form-control input-sm chat-input" placeholder="Unidades" required/>
</br>
	</div>
			<div class="col-md-2">
			<label for="valorcompra">Compra paquete</label>
			<input type="number" id="valorcompra" name="valorcompra" class="form-control input-sm chat-input" placeholder="Valor compra" required/>
            </br>
			</div>	
			<div class="col-md-2">
			<label for="pvp">Venta unidad</label>
			<input type="number" id="pvp" name="pvp" class="form-control input-sm chat-input" placeholder="Precio venta" required/>
            </br>
			</div>
			<div class="col-md-3">
			<label for="plu">PLU</label>
			<input type="number" id="plu" name="plu" class="form-control input-sm chat-input" placeholder="PLU" required/>
            </br>
			</div>			
</div>
            <div class="wrapper">
			<button type="submit" class="btn btn-primary">Crear</button>          
            </div>
			</form>
</div>
</div>
<?php	
include("footersadmin.html");
?>
</body>
</html>