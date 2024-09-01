<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
include_once('bas/conn.php');
mysqli_set_charset($conx,"utf8");
?>
<body>
<div class="container"> 
<div class="jumbotron">
<?php
//echo $sql2;

$searchp="select * from pedidos where estado='1' order by fecha asc";
$resultap = mysqli_query($conx,"$searchp");

while ($resultxp = mysqli_fetch_array($resultap)) {
$fecha=$resultxp['fecha'];
$total=$resultxp['total'];
$idpedidos=$resultxp['idpedidos'];
$factura=$resultxp['documento'];
$idproveedores=$resultxp['idproveedores'];

$search1="select * from proveedores where idproveedores='$idproveedores'";
$resulta1 = mysqli_query($con,"$search1");

while ($resultx1 = mysqli_fetch_array($resulta1)) {
$razonsocial=$resultx1['nombre'];
}
?>

<p>	
<div class="row">
			<form id="sumar" action = "edicionpedido.php" method = "get" >
			
			<div class="col-md-2">
            <label for="Fecha">Fecha : </label><input type="text" id="Fecha" name="Fecha" value="<?php echo $fecha;?>" class="form-control input-sm chat-input" readonly/>			
			</div>
			<div class="col-md-3">
            <label for="Proveedor">Proveedor : </label><input type="text" id="Proveedor" name="Proveedor" value="<?php echo $razonsocial;?>" class="form-control input-sm chat-input" readonly/>			
			</div>
			<div class="col-md-3">
            <label for="Factura">Factura : </label><input type="text" id="Factura" name="Factura" value="<?php echo $factura;?>" class="form-control input-sm chat-input" readonly/>			
			</div>
			<div class="col-md-3">
            <label for="Total">Total : </label><input type="text" id="Total" name="Total" value="<?php echo $total;?>" class="form-control input-sm chat-input" readonly/>			
			</div>
			
            <input type="hidden" id="idpedidos" name="idpedidos" value="<?php echo "$idpedidos";?>">  
            
            <div class="col-md-2"><br>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>			
			</form>	
</div>
</p>
<hr>

<?php
}
?>

</div>
</div>

<?php	
include("footersadmin.html");
?>
</body>
</html>