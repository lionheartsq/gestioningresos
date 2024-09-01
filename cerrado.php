<!DOCTYPE html>
<html lang="es">

<?php
	$fecha = date("y-m-d");
	$hoy="20$fecha";

	include("menutienda.html");
	include_once('bas/conx.php');
	include_once('bas/conn.php');
	mysqli_set_charset($conx,"utf8");

	$idfacturas=$_GET['idfacturas'];
	$idclientes=$_GET['idclientes'];
?>

<body>
  <div class="container"> 
	<div class="jumbotron">

<?php
	$search="select * from facturas where idfacturas='$idfacturas'";
	$resulta = mysqli_query($conx,"$search");

	if($resulta){

		while ($resultx = mysqli_fetch_array($resulta)) {
			
			$idfacturas=$resultx['idfacturas'];
			$fecha=$resultx['fecha'];
			$valor=$resultx['total'];

			$queryur="select SUM(valorentrada) as valorentrada,
			sum(valorsalida) as valorsalida from tienda where 
			idclientes=$idclientes;";	

			$result1r=mysqli_query($conx,$queryur);

			while ($resultxr = mysqli_fetch_array($result1r)) {
				$entradas=$resultxr['valorentrada'];
				$salidas=$resultxr['valorsalida'];
			}

			$saldo=$entradas-$salidas;

			$queryux="select * from residentes where idresidentes=$idclientes;";	

			$result1x=mysqli_query($con,$queryux);

			while ($resultax = mysqli_fetch_array($result1x)) {
					$nombre=$resultax['nombresr'];
					$apellido=$resultax['apellidosr'];
			}
?>
		<div class="row">
			<div class="col-md-12">
            <h2>Residente: <?php echo "$nombre $apellido<br>";?></h2>
            <br>
			</div>		
		</div>
		<hr>

		<div class="row ui-widget" style="background:white;">
			<div class="col-md-4">
			<b>Resumen factura</b>	
			</div>	
			<div class="col-md-4">
			<b>Total Factura: <?php echo $valor;?></b>			
			</div>
			<div class="col-md-4">
			<b>Nuevo Saldo: <?php echo $saldo;?></b>			
			</div>			
</div>
<div class="row">
			<div class="col-md-12">
            <h2><a href="index.php">Facturar Nuevo</a></h2>
            <br>
			</div>		
</div>
<hr>
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

</body>

<?php	
include("footersadmin.html");
?>
</body>
</html>