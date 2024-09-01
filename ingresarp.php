<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conx.php');
include_once('bas/conn.php');
mysqli_set_charset($conx,"utf8");

$fecha=$_POST['fecha'];
$factura=$_POST['factura'];
$total=$_POST['total'];
$proveedor=$_POST['proveedor'];

$sql2="INSERT INTO pedidos(fecha,documento,total,estado,idproveedores) VALUES ('$fecha','$factura','$total','1','$proveedor')";	
$result2 = mysqli_query($conx,"$sql2");
$rt = mysqli_query($conx,"SELECT @@identity AS id");
if ($row = mysqli_fetch_row($rt)) {
$idfact = trim($row[0]);
}	

$search1="select * from proveedores where idproveedores='$proveedor'";
$resulta1 = mysqli_query($con,"$search1");

if($resulta1){
while ($resultx1 = mysqli_fetch_array($resulta1)) {
$razonsocial=$resultx1['nombre'];
}
}
?>
<body>
<div class="container"> 
<div class="jumbotron">
<?php
//echo $sql2;

$search="select * from pedidos where idpedidos='$idfact'";
$resulta = mysqli_query($conx,"$search");

if($resulta){
while ($resultx = mysqli_fetch_array($resulta)) {
$nidpedidos=$resultx['idpedidos'];
$nfecha=$resultx['fecha'];
$nfactura=$resultx['documento'];
$nvalor=$resultx['total'];
$idproveedores=$resultx['idproveedores'];
?>
<div class="row">
			<div class="col-md-4">
			<h2>Fecha : <?php echo "$nfecha";?></h2>
            <br>			
			</div>
			<div class="col-md-4">
			<h2>Factura # <?php echo "$nfactura";?></h2>
            <br>			
			</div>
			<div class="col-md-4"><br>
            Proveedor: <?php echo "$razonsocial<br>";?>
            <br>
			</div>		
</div>
<p>	
<div class="row">
			<form id="sumar" action = "sumarp.php" method = "post" >
			
			<div class="col-md-2">
			<label for="cantidadp">Cantidad</label>
			<input type="number" step="0.01" min="0" id="cantidad" name="cantidad" class="form-control input-sm chat-input"  value="" required/>
            <br>
			</div>
			
			<div class="col-md-6">
            <label for="plu">PLU : </label><input type="text" id="plu" name="plu" class="form-control input-sm chat-input" autofocus required/>			
			</div>

            <input type="hidden" id="idpedidos" name="idpedidos" value="<?php echo "$idfact";?>">  
            <input type="hidden" id="idproveedores" name="idproveedores" value="<?php echo "$idproveedores";?>">  
            <input type="hidden" id="fechaf" name="fechaf" value="<?php echo "$fecha";?>">  
            <input type="hidden" id="nombre" name="nombre" value="<?php echo "$razonsocial";?>">  
			<input type="hidden" id="factura" name="factura" value="<?php echo "$nfactura";?>">  
            <input type="hidden" id="saldo" name="saldo" value="<?php echo "$total";?>">  
            
            <div class="col-md-2"><br>
                <button type="submit" class="btn btn-primary">Añadir</button>
            </div>			
			</form>	
</div>
</p>
<?php
}
}
else{
?>	
<p>Error en la base de datos.</p>
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