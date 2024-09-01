<HTML>
<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include("menutienda.html");
include_once('bas/conx.php');

@mysqli_set_charset($con,"utf8");

$fecha = date("y-m-d");
$hoy="20$fecha";
?>
<body>

<div class="container">  
<div class="jumbotron">

<center><h2>Carga de saldos</h2></center>
		
		<form id="verlista" action = "verlista.php" method = "get"> 
		<div class="row ui-widget">
			<div class="col-md-4"><br>
			<b>Ventas tienda</b>
			</div>			
			<div class="col-md-7">
				<body onload="document.getElementById('cod').focus()"><br>
				<label for="cod">Cedula: </label>
	            <input type="number" id="cod" name="cod" autofocus required/>            			
			</div> 
			<div class="col-md-1"><br>
				<button type="submit" class="btn btn-success">Buscar</button>  			
			</div>
		</div>
		</form>
			

</div>
</div>

</body>
</html>
<?php
include("footersadmin.html");
?>