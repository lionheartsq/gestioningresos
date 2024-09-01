<!DOCTYPE html>
<html lang="es">

<?php
	include("menutienda.html");
	include_once('bas/conn.php');	
	include_once('bas/conx.php');
	include("prodac.html");
	mysqli_set_charset($conx,"utf8");

	$idclientes=$_GET['idclientes'];
	$hoy=$_GET['fechaf'];
	$nombre=$_GET['nombre'];
	$saldo=$_GET['saldo'];

	$sql2="INSERT INTO facturas(fecha,idclientes) VALUES ('$hoy','$idclientes')";	
	$result2 = mysqli_query($conx,"$sql2");
	$rt = mysqli_query($conx,"SELECT @@identity AS id");
	
		if ($row = mysqli_fetch_row($rt)) {
			$idfact = trim($row[0]);
		}
?>
<body>
  <div class="container"> 
	<div class="jumbotron">
<?php
$search="select * from facturas where idfacturas='$idfact'";
$resulta = mysqli_query($conx,"$search");
if($resulta){

	while ($resultx = mysqli_fetch_array($resulta)) {
	$idfacturas=$resultx['idfacturas'];
	$fecha=$resultx['fecha'];
?>
		<div class="row">
			<div class="col-md-4"><br>
            Cliente: <?php echo "$nombre";?><br>
            Saldo: <?php echo "$saldo";?>
            <br>
			</div>		

			<form id="sumar" action = "sumar.php" method = "post" >
			

			<div class="col-md-6">
            <label for="plu">PLU : </label><input type="text" id="plu" name="plu" class="form-control input-sm chat-input" autofocus required/>			
			</div>

            <input type="hidden" id="idfacturas" name="idfacturas" value="<?php echo "$idfacturas";?>">  
            <input type="hidden" id="idclientes" name="idclientes" value="<?php echo "$idclientes";?>">  
            <input type="hidden" id="fechaf" name="fechaf" value="<?php echo "$fecha";?>">  
            <input type="hidden" id="nombre" name="nombre" value="<?php echo "$nombre";?>">  
            <input type="hidden" id="saldo" name="saldo" value="<?php echo "$saldo";?>">  
            
            <div class="col-md-2"><br>
                <button type="submit" class="btn btn-primary">Añadir</button>
            </div>			
			</form>	

		</div>		

<?php
}
}else{
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