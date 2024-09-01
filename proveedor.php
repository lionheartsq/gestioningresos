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
?>
<HEAD>
</HEAD>

  <div class="container">  
<div class="jumbotron">
<body>
<center><h2>Crear proveedor nuevo</h2></center>
<form id="cproveedor" action = "cproveedor.php" method = "get"> 
<center><div>
  <label>Nombre del proveedor:</label><input type="text" id="resX" name="resX" class="form-control input-sm chat-input" style="width:80%"></input>
</div></center>
<br>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-warning">Crear</button>          
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