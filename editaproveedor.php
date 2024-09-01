<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include("menutienda.html");
include_once('bas/conx.php');

$idpagos=$_REQUEST['idpa'];

mysqli_set_charset($conx,"utf8");
?>
<body>

<div class="container">
<div class="jumbotron">
<?php

$queryu="select * from pagos where idpagos=$idpagos;";	
$result1=mysqli_query($conx,$queryu);

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fechaabono'];
$valorentrada=$resultx['valorpago'];
$valorsalida=$resultx['abono'];
$idpr=$resultx['idpedidos'];

if($valorentrada>0){
	$valor=$valorentrada;
	$opcion=1;
	$nomop="Entrada";
}
else{
	$valor=$valorsalida;
	$opcion=2;
	$nomop="Salida";
}
}
?>
<center><h1>Edición de registros</h1></center>
<br>
<center>
<div class="row" style="width:80%;">
<form id="movtienda" action = "editproveedor.php" method = "get"> 
<div class="col-md-2">
<label>Fecha:</label>
<input type="date" id="fecha" name="fecha" min="2018-01-01" class="form-control input-sm chat-input" value='<?php echo $fecha;?>' required/>
</div>
<div class="col-md-2">
<label>Tipo:</label> 
<select id="tipologia" name="tipologia" class="form-control input-sm chat-input">
<option value='<?php echo $opcion;?>'><?php echo $nomop; ?></option>
<option value="2">Salida</option>
<option value="1">Entrada</option>
</select><br>
</div>
<div class="col-md-3">
<label>Valor:</label>
<input type="number" min="1" id="valor" name="valor" class="form-control input-sm chat-input"value='<?php echo $valor;?>'></input>
</div>
  <input type="hidden" id="idpagos" name="idpagos" value="<?php echo $idpagos;?>"></input>  
<div class="wrapper col-md-2"><br>
<button type="submit" class="btn btn-danger">Modificar movimiento</button>          
</div>
</form>
</div></center>

</div>
</div>

<?php	
include("footersadmin.html");
?>
</body>
</html>