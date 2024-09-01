<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");
mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 
?>

<div class="container">
<div class="jumbotron">

<center><div>
<h2>Facturas pendientes</h2>
  <label>Proveedor:</label>
<form id="resumenprov" action = "resumenprov.php" method = "get"> 
<select id="idproveedores" name="idproveedores" class="form-control input-sm chat-input">
<?php
$query="select * from proveedores where estado='1'";
$result=mysqli_query($con,$query);
while ($resultax = mysqli_fetch_array($result)) {
$nomprov=$resultax['nombre'];
$idproveedores=$resultax['idproveedores'];
echo "<option value='$idproveedores'>$nomprov</option>";
}
?>
</select>

</div></center>
<br>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-warning">Buscar</button>  
</form>        
</div>
<br><br>

<center><div>
<h2>Facturas canceladas</h2>
  <label>Proveedor:</label>
<form id="resumenprovp" action = "resumenprovp.php" method = "get"> 
<select id="idproveedores" name="idproveedores" class="form-control input-sm chat-input">
<?php
$query="select * from proveedores";
$result=mysqli_query($con,$query);
while ($resultax = mysqli_fetch_array($result)) {
$nomprov=$resultax['nombre'];
$idproveedores=$resultax['idproveedores'];
echo "<option value='$idproveedores'>$nomprov</option>";
}
?>
</select>

</div></center>
<br>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-warning">Buscar</button>  
</form>        
</div>
<br><br>
<div><center>
<a href="resumentodos.php">Ver todos</a>
</div></center>

</div>
</div>
<?php
include("footersadmin.html");
?>
