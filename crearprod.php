<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");

$comercial=$_POST['comercial'];
$unidades=$_POST['unidades'];
$valorcompra=$_POST['valorcompra'];
$valorunidad=($valorcompra/$unidades);
$pvp=$_POST['pvp'];
$plu=$_POST['plu'];

$sql="INSERT INTO productos(plu,detalle,unidades,valorcompra,valorcomprap,pvp,estado)
VALUES ('$plu','$comercial','$unidades','$valorunidad','$valorcompra','$pvp','1')";	
$result = mysqli_query($conx,$sql);
?>
<body>
  <div class="container"> 
<div class="jumbotron">
<br>
<?php
//echo $sql;
if($result){
?>
<center><h1>Producto creado</h1></center>
<div class="row">
			<div class="col-md-12">
            <h2><a href="product.php">Nuevo Producto</a></h2>
            <br>
			</div>		
</div>
<?php
}
else{
?>
<center><h2>No se creo el producto, verifique los datos</h2></center>
<?php
}
?>
</div>
</div>

</body>

<?php	
include("footersadmin.html");
?>
</body>
</html>