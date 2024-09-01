<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

if (isset($_GET['indicador']))
{
$flag=$_GET['indicador'];
$idproductos=$_GET['idproductos'];
$cantidad=$_GET['cantidad'];
$precio=$_GET['precio'];
$idfacturas=$_GET['idfacturas'];
$importe=($cantidad*$precio);

$sqlxr="UPDATE detalleventa SET cantidad='$cantidad',valor='$importe',idproductos='$idproductos' WHERE iddetalleventa='$flag'";
$resultxr = mysqli_query($con,$sqlxr);
}

else{
$idfacturas=$_POST['idfacturas'];
$idproductos=$_POST['idproductos'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];
$importe=$_POST['importe'];

$sql="INSERT INTO detalleventa(cantidad,valor,idventa,idproductos) 
VALUES ('$cantidad','$importe','$idfacturas','$idproductos')";	

$result = mysqli_query($con,"$sql");
$rs = mysqli_query($con,"SELECT @@identity AS id");
if ($row = mysqli_fetch_row($rs)) {
$idcl = trim($row[0]);
}

}
?>
<body>
  <div class="container"> 
<div class="jumbotron">
<?php
$search="select * from venta join residentes on residentes.idresidentes=venta.idresidentes where idventa='$idfacturas'";
$resulta = mysqli_query($con,"$search");

if($resulta){

while ($resultx = mysqli_fetch_array($resulta)) {
$idfacturas=$resultx['idventa'];
$fecha=$resultx['fecha'];
$nombre=$resultx['nombresr'];
$apellido=$resultx['apellidosr'];
?>
<div class="row">
			<div class="col-md-4"><br>
            Cliente: <?php echo "$nombre $apellido";?>
            <br>
			</div>		
</div>
<p>	
    <form id="sumar" action = "sumare.php" method = "post" >

<div class="row ui-widget" id="suma">

			<div class="col-md-4">
			<label for="idproductos">Producto</label>
<select id="idproductos" name="idproductos" class="form-control input-sm chat-input">
<?php
$selectciudad=mysqli_query($con,"select * FROM productos where estado='1' order by detalle asc");
		while ($resultc = mysqli_fetch_array($selectciudad)) {
		$idproductos=$resultc['idproductos'];
		$detalle=$resultc['detalle'];
		$valorventa=$resultc['valorventa'];
		
$queryinv="SELECT SUM(cantidad) as inventario FROM detallepedido where idproductos='$idproductos'";
$resultinv=mysqli_query($con,$queryinv);
while ($resultainv = mysqli_fetch_array($resultinv)) {
$inventario=$resultainv['inventario'];	
}

$queryven="SELECT SUM(cantidad) as ventas FROM detalleventa where idproductos='$idproductos'";
$resultven=mysqli_query($con,$queryven);
while ($resultaven = mysqli_fetch_array($resultven)) {
$ventas=$resultaven['ventas'];	
}

$stock=$inventario-$ventas;
		echo "<option value='$idproductos'>$detalle | $stock disponibles | $$valorventa</option>";
		}
?>
</select>
            <br>			
			</div>	
			<div class="col-md-2">
			<label for="cantidad">Cantidad</label>
			<input type="number" step="0.01" min="0" id="cantidad" name="cantidad" class="form-control input-sm chat-input"  value="" required/>
            <br>
			</div>
			<div class="col-md-2">
			<label for="precio">Precio </label>
			<input type="number" id="precio" name="precio" class="form-control input-sm chat-input" required/>
            <br>
			</div>
			<div class="col-md-2">
			<label for="importe">Total </label>
			<input type="number" id="importe" name="importe" class="form-control input-sm chat-input" value="" required/>
            <br>
			</div>
<input type="hidden" id="idfacturas" name="idfacturas" value="<?php echo "$idfacturas";?>">  
            <div class="col-md-2"><br>
			<button type="submit" class="btn btn-primary">Añadir</button>          
            </div>			
</div>		
			</form>	
</p>

<hr>
<?php
}
}else{
?>	
<p>Error en la base de datos.</p>
<?php	
}
?>

<div class="table-responsive" style="background:white;">
<p>&nbsp;Productos añadidos</p>
<table class="display" cellspacing="0" width="100%">
<thead>
<tr>
<th>Producto</th>	
<th>Cant</th>
<th>Precio</th>
<th>Total</th>
<th>Editar</th>
</tr>
</thead>
<tbody>
<?php
$totales="select productos.idproductos as idpr, productos.detalle as descripcionx, productos.valorventa as preciox, detalleventa.cantidad as medicionx, detalleventa.valor as importex, detalleventa.iddetalleventa as indicador, detalleventa.idventa as idfra from detalleventa join productos on detalleventa.idproductos=productos.idproductos where detalleventa.idventa='$idfacturas'";

$totalimport=0;

$resultax = mysqli_query($con,$totales);

while ($resultxs = mysqli_fetch_array($resultax)) {
$idpr=$resultxs['idpr'];
$idfra=$resultxs['idfra'];
$actividadx=$resultxs['descripcionx'];
$preciox=$resultxs['preciox'];
$udsx=$resultxs['medicionx'];
$importex=$resultxs['importex'];
$indicador=$resultxs['indicador'];
?>
<form id="sumar2" action = "sumare.php" method = "get" >
<tr>
<td>
<select id="idproductos" name="idproductos">
<option value="<?php echo $idpr;?>"><?php echo $actividadx;?></option>
<?php
$selcx="select * FROM productos order by detalle asc";
$selectciudadx=mysqli_query($con,$selcx);
		while ($resultcx = mysqli_fetch_array($selectciudadx)) {
		$idprx=$resultcx['idproductos'];
		$detalle=$resultcx['detalle'];
		$valorventa=$resultcx['valorventa'];
	
$queryinv="SELECT SUM(cantidad) as inventario FROM detallepedido where idproductos='$idprx'";
$resultinv=mysqli_query($con,$queryinv);
while ($resultainv = mysqli_fetch_array($resultinv)) {
$inventario=$resultainv['inventario'];	
}

$queryven="SELECT SUM(cantidad) as ventas FROM detalleventa where idproductos='$idprx'";
$resultven=mysqli_query($con,$queryven);
while ($resultaven = mysqli_fetch_array($resultven)) {
$ventas=$resultaven['ventas'];	
}

$stock=$inventario-$ventas;
		echo "<option value='$idprx'>$detalle | $stock disponibles | $$valorventa</option>";
		}
?>
</select>
</td><!--Detalle-->
<td><input type="number" id="cantidad" name="cantidad" class="form-control input-sm chat-input" value="<?php echo $udsx;?>"/></td><!--Cantidad-->
<td><input type="number" id="precio" name="precio" class="form-control input-sm chat-input" value="<?php echo $preciox;?>"/></td><!--Precio-->
<td><input type="number" id="total" name="total" class="form-control input-sm chat-input" value="<?php echo $importex;?>"/></td><!--Cantidad-->
<input type="hidden" id="indicador" name="indicador" value="<?php echo "$indicador";?>">
<input type="hidden" id="idfacturas" name="idfacturas" value="<?php echo "$idfra";?>">
<td><button type="submit" class="btn btn-danger">Editar</button></td>          
</tr>			
</form>
<?php
$totalimport=$totalimport+$importex;
}//fin for
?>
</tbody>
</table>
</div>
<hr>
	<div class="row ui-widget" style="background:cyan;">
			<div class="col-md-5">
			<b>Resumen factura</b>	
			</div>	
			<div class="col-md-4">
			<b>Total: <?php echo $totalimport;?></b>			
			</div>
			<div class="col-md-3">
			<?php $url="cerrare.php?idproyectos=$idfacturas&totalimporte=$totalimport";?>
			<a href="<?php echo $url;?>"><button type="button" class="btn btn-danger">Finalizar</button></a>
			</div>			
	</div>

</div>
</div>

    <script type='text/javascript'>
        // Cada vez que se pulse una tecla, controlamos que sea numerica
        $("#suma input").keypress(function(event) {
            //obtenemos la tecla pulsada
            var valueKey=String.fromCharCode(event.which);
            //obtenemos el valor ascii de la tecla pulsada
            var keycode=event.which;
            
            // Si NO pulsamos un numero, un punto, la tecla suprimir
            // la tecla backspace o el simobolo "-" (45), cancelamos la pulsacion
            if(valueKey.search('[0-9|\.]')!=0 && keycode!=8 && keycode!=46 && keycode!=45)
            {
                // anulamos la pulsacion de la tecla
                return false;
            }
        });
        
        // evento que se ejecuta cada vez que se suelte la tecla en cualquiera de
        // los tres inputs
        $("#suma input").keyup(function(event) {
            calcular();
        });
        
        // Calculamos la suma de los dos valores
        function calcular()
        {
            var valor1=validarNumero('#cantidad');
            var valor2=validarNumero('#precio');

			var n = (valor1*valor2);
			var na=(parseFloat(n).toFixed(2));			
            
            $("#importe").val(na);	
        }
        
        // Funcion para validar que el numero sea correcto, y para cambiar el color
        // del marco en caso de error
        function validarNumero(id)
        {
            if($.isNumeric($(id).val()))
            {
                $(id).css('border-color','#808080');
                return parseFloat($(id).val());
            }else if($(id).val()==""){
                $(id).css('border-color','#808080');
                return 0;
            }else{
                $(id).css('border-color','#f00');
                return 0;
            }
        }
    </script>

</body>

<?php	
include("footersadmin.html");
?>
</body>
</html>