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

$searchp="select * from facturas where estado='1' order by fecha asc";
$resultap = mysqli_query($conx,"$searchp");

while ($resultxp = mysqli_fetch_array($resultap)) {
$fecha=$resultxp['fecha'];
$total=$resultxp['total'];
$idpedidos=$resultxp['idfacturas'];
$idproveedores=$resultxp['idclientes'];

$search1="select * from residentes where idresidentes='$idproveedores'";
$resulta1 = mysqli_query($con,"$search1");

while ($resultx1 = mysqli_fetch_array($resulta1)) {
$nombres=$resultx1['nombresr'];
$apellidos=$resultx1['apellidosr'];
$razonsocial=$nombres." ".$apellidos;
}
?>

<p>	
<div class="row">
			<form id="sumar" action = "edicionfactura.php" method = "get" >
			
			<div class="col-md-2">
            <label for="Fecha">Fecha : </label><input type="text" id="fecha" name="fecha" value="<?php echo $fecha;?>" class="form-control input-sm chat-input" readonly/>			
			</div>
			<div class="col-md-3">
            <label for="residente">Residente : </label><input type="text" id="residente" name="residente" value="<?php echo $razonsocial;?>" class="form-control input-sm chat-input" readonly/>			
			</div>
			<div class="col-md-3">
            <label for="Factura">Factura : </label><input type="text" id="factura" name="factura" value="<?php echo $idpedidos;?>" class="form-control input-sm chat-input" readonly/>			
			</div>
			<div class="col-md-3">
            <label for="Total">Total : </label><input type="text" id="total" name="total" value="<?php echo $total;?>" class="form-control input-sm chat-input" readonly/>			
			</div>
			
            <input type="hidden" id="idresidentess" name="idresidentes" value="<?php echo "$idproveedores";?>">  
			
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