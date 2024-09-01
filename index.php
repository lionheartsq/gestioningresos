<HTML>
<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include("menutienda.html");
include_once('bas/conn.php');
$fecha = date("y-m-d");
$hoy="20$fecha";

if (isset($_GET['idaviso'])){
$cedula=$_GET['idaviso'];	
$aviso="El residente con cedula: $cedula no existe, revise la cédula";
}
else{
$aviso="";	
}

?>
<body>
<div class="container">  
	<div class="jumbotron">
		<div class="row ui-widget">
		<form id="crear" action = "crear.php" method = "post">
			<div class="col-md-4"><br>
			<b>Ventas tienda</b>
			</div>			
			<div class="col-md-6">
				<body onload="document.getElementById('cod').focus()"><br>
				<label for="cod">Cedula: </label>
	            <input type="number" id="cod" name="cod" autofocus required/>            			
			</div> 
			<div class="col-md-2"><br>
				<button type="submit" class="btn btn-success">Facturar</button>  			
			</div>
		</form>
		</div>	
<?php
echo "<b style='color:red;'>$aviso</b>";
?>
<hr style="background: red; height: 3px; width: 100%; border: 0">
<hr style="background: red; height: 3px; width: 100%; border: 0">

<div class="row ui-widget">
			<div class="col-md-6">
<center><h2>Ventas en efectivo</h2></center>
		
<div class="row ui-widget">
<form id="crearpe" action = "crear.php" method = "post" >
			<div class="col-md-8">
			<label for="nombre">Nombre</label>
<select id="cod" name="cod" class="form-control input-sm chat-input">
<option value='a'>Venta POS</option> <!-- Residente 7 para venta efectivo -->
</select>
            </br>
			</div>	
			<div class="col-md-4"><br>
			<button type="submit" class="btn btn-warning">Facturar</button>         
			</div>
			</form>
		</div>	

</div>
<div class="col-md-6">
<h2>Internas</h2>
<div class="row ui-widget">
<form id="crearp" action = "crear.php" method = "post" >
			<div class="col-md-8">
			<label for="nombre">Nombre</label>
<select id="cod" name="cod" class="form-control input-sm chat-input">
<option value='1'>Venta Interna</option> <!-- Residente 1 para venta especial -->
</select>
            </br>
			</div>	
			<div class="col-md-4"><br>
			<button type="submit" class="btn btn-danger">Facturar</button>         
			</div>
			</form>
		</div>	
</div>	

</div>	

</div>
</div>

</body>
</html>
<?php
include("footersadmin.html");
?>