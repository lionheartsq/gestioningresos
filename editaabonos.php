<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];	
	
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menusadmin.html");

$idresidentes=$_REQUEST['idr'];
$idabonopensiones=$_REQUEST['idab'];

mysqli_set_charset($con,"utf8");
?>

<body>

<div class="container">
<div class="jumbotron">
<?php

$queryu="select * from abonopensiones where idabonopensiones=$idabonopensiones;";	
$result1=mysqli_query($con,$queryu);

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fechaabono'];
$valor=$resultx['abono'];
$observaciones=$resultx['comentario'];
$idcobrospension=$resultx['idcobrospension'];
}
?>
<center><h1>Edición de abonos</h1></center>
<br>
<center>
<div class="row" style="width:80%;">
<form id="movtienda" action = "editabo.php" method = "get"> 
<div class="col-md-2">
<label>Fecha abono:</label>
<input type="date" id="fecha" name="fecha" min="2018-01-01" class="form-control input-sm chat-input" value='<?php echo $fecha;?>' required/>
</div>
<div class="col-md-3">
<label>Valor:</label>
<input type="number" min="0" id="valor" name="valor" class="form-control input-sm chat-input"value='<?php echo $valor;?>'></input>
</div>
<div class="col-md-3">
<label>Comentario:</label>
<input type="text" id="obs" name="obs" value='<?php echo $observaciones;?>' class="form-control input-sm chat-input"></input>
</div>
  <input type="hidden" id="idabonopensiones" name="idabonopensiones" value="<?php echo $idabonopensiones;?>"></input>  
  <input type="hidden" id="idcobrospension" name="idcobrospension" value="<?php echo $idcobrospension;?>"></input>  
<div class="wrapper col-md-2"><br>
<button type="submit" class="btn btn-danger">Modificar movimiento</button>          
</div>
</form>
</div></center>

</div>
</div>


?>
</body>
</html>
<?php
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>