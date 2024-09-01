<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$fecha = date("y-m-d");
$hoy="20$fecha";
?>

<style>
.wrapper {
    text-align: center;
}
.btn{
	background-color:#941524;
	border-color:transparent;
	color:white;
	font-size:1.5em;
}
.btn:hover{
	background-color:#523a18;
	border-color:transparent;
	color:white;
}
</style>

<body>
  <div class="container"><br>
<div class="jumbotron">

<center><h1>Ingreso de pedidos</h1></center><br><br>
		<form id="ingresarp" action = "ingresarp.php" method = "post" >
		
<div class="row ui-widget">	
<div class="col-md-2">		
<label for="fecha">fecha</label><br>
<input type="date" class="form-control input-sm chat-input" id="fecha" name="fecha"value="<?php echo $hoy; ?>" required/>		
</div>
<div class="col-md-2">
<label for="factura">Factura</label><br>
<input type="text" class="form-control input-sm chat-input" id="factura" name="factura" required/>
</div>	
<div class="col-md-4">
<label for="proveedor">Proveedor</label><br>
<select id="proveedor" name="proveedor" class="form-control input-sm chat-input">
<?php
$selectprov=mysqli_query($con,"select * FROM proveedores where estado='1'");
		while ($resultc2 = mysqli_fetch_array($selectprov)) {
		$idproveedores=$resultc2['idproveedores'];
		$razonsocial=$resultc2['nombre'];
		echo "<option value='$idproveedores'>$razonsocial</option>";
		}
?>
</select>
</div>	
			<div class="col-md-2">
			<label for="total">Total</label>
			<input type="number" id="total" name="total" class="form-control input-sm chat-input" placeholder="Valor total" required/>
            </br>
			</div><br>	

            <div class="wrapper">
			<button type="submit" class="btn btn-primary">Registrar</button>        
            </div>
			</form>
	</div>		
</div>
</div>
<?php	
include("footersadmin.html");
?>
</body>
</html>