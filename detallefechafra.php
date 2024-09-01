<HTML>
<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include("menutienda.html");
include_once('bas/conn.php');

mysqli_set_charset($con,"utf8");

$fecha = date("y-m-d");
$hoy="20$fecha";
?>
  <div class="container">  
<div class="jumbotron">
<body>
<center><h2>Ver Facturas</h2></center>
<form id="verlista" action = "verlistafecha.php" method = "get"> 
<center><div>
  <label>Fecha:</label>
<input type="date" id="idresidentes" name="idresidentes"></input>

</div></center>
<br>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-warning">Buscar</button>          
</div>
</center>
</form>
</div>
</div>

</body>
</html>
<?php
include("footersadmin.html");
?>