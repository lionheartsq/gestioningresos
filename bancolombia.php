<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");

$hoy = date("y-m-d");
$fecham="20$hoy"; 
?>
<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">
<center>
<div class="table-responsive">
<table id="tabla" class="display" cellspacing="0" width="100%">

<thead>
    <tr>
<th>Fecha</th>
<th>Concepto</th>
<th>Entrada</th>
<th>Salida</th>
<th>Saldo</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Concepto</th>
<th>Entrada</th>
<th>Salida</th>
<th>Saldo</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
?>
<center><img src="images/bancolombia.png"></img></center>
<center><h2>Resumen Bancolombia</h2></center>

<?php
$queryu="select * from colombia order by fecha,idcolombia asc;";	

//echo "$queryu";

$result1=mysqli_query($con,$queryu);

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$observaciones=$resultx['concepto'];
$valorentrada=$resultx['valorentrada'];
$valorsalida=$resultx['valorsalida'];
$acumulado=$resultx['acumulado'];
$idcolpatria=$resultx['idcolombia'];
?>
<tr>
<td><a href='editabancolombia.php?idt=<?php echo "$idcolpatria"; ?>'><?php echo "$fecha"; ?></a></td>
<td><?php echo "$observaciones"; ?></td>
<td><?php echo "$valorentrada"; ?></td>
<td style="color:red;"><?php echo "$valorsalida"; ?></td>
<?php
if($acumulado>0){
?>
<td><?php echo "$acumulado"; ?></td>
<?php	
}
else{
?>	
<td style="color:red;"><?php echo "$acumulado"; ?></td>	
<?php
}
?>
</tr>
<?php
}
?>
</tbody>

</table>
</div>
</center>
<br><br>
<center>
<div class="row">
<form id="movtienda" action = "movcolombia.php" method = "get"> 
<div class="col-md-2">
<label>Fecha:</label>
<input type="date" id="fecha" name="fecha" min="2018-01-01" class="form-control input-sm chat-input" value='<?php echo $fecham;?>' required/>
</div>
<div class="col-md-3">
<label>Concepto:</label>
<input type="text" id="obs" name="obs" class="form-control input-sm chat-input"></input>
</div>
<div class="col-md-2">
<label>Tipo:</label> 
<select id="tipologia" name="tipologia" class="form-control input-sm chat-input">
<option value="2">Salida</option>
<option value="1">Entrada</option>
</select><br>
</div>
<div class="col-md-3">
<label>Valor:</label>
<input type="number" min="1" id="valor" name="valor" class="form-control input-sm chat-input"></input>
</div>
<div class="wrapper col-md-2"><br>
<button type="submit" class="btn btn-danger">Ingresar movimiento</button>          
</div>
</form>
</div></center>

<script type="text/javascript">
$(window).load(function() {
	$('#preloader').fadeOut('slow');
	$('body').css({'overflow':'visible'});
})
</script>

</div>
</div>
<?php
include("footersadmin.html");
?>