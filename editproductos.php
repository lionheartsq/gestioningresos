<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");

$idproductos=$_POST['idproductos'];
$comercial=$_POST['comercial'];
$unidades=$_POST['unidades'];
$valorcompra=$_POST['valorcompra'];
$valorunidad=($valorcompra/$unidades);
$pvp=$_POST['pvp'];
$plu=$_POST['plu'];

$sql="UPDATE productos SET plu='$plu',detalle='$comercial',unidades='$unidades',valorcompra='$valorunidad',
valorcomprap='$valorcompra',pvp='$pvp' where idproductos='$idproductos'";	
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
<center><h1>Producto editado</h1></center>
<div class="row">
			<div class="col-md-12">
            <h2><a href="elproductos.php">Editar Nuevo Producto</a></h2>
            <br>
			</div>		
</div>
<?php
}
else{
?>
<center><h2>No se edito el producto, verifique los datos</h2></center>
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