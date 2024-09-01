<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");

$hoy = date("y-m-d");
$fecham="20$hoy"; 
$cedresidente=$_REQUEST['cod'];
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
<th>Entrada</th>
<th>Salida</th>
<th>Saldo</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Entrada</th>
<th>Salida</th>
<th>Saldo</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
$query="select nombresr,apellidosr,idresidentes from residentes where documentor=$cedresidente;";

$result=mysqli_query($con,$query);

while ($resultax = mysqli_fetch_array($result)) {
$idresidentes=$resultax['idresidentes'];
$nombres=$resultax['nombresr'];
$apellidos=$resultax['apellidosr'];
$nomresidente="$nombres"." "."$apellidos";
}
?>

<center><h2><?php echo $nomresidente; ?></h2></center>

<?php
$queryu="select * from tienda where idclientes=$idresidentes order by fecha asc;";	

//echo "$queryu";
//voy aca

$result1=mysqli_query($conx,$queryu);

$acumval=0;
$acumab=0;

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$valorentrada=$resultx['valorentrada'];
$valorsalida=$resultx['valorsalida'];
$idtienda=$resultx['idtienda'];
$acumval=$acumval+$valorentrada;
$acumab=$acumab+$valorsalida;
$saldo=$acumval-$acumab;
?>
<tr>
<td><a href='editatienda.php?idt=<?php echo "$idtienda"; ?>&idr=<?php echo "$idresidentes"; ?>'><?php echo "$fecha"; ?></a></td>
<td><?php echo "$valorentrada"; ?></td>
<td style="color:red;"><?php echo "$valorsalida"; ?></td>
<?php
if($saldo>0){
?>
<td><?php echo "$saldo"; ?></td>
<?php	
}
else{
?>	
<td style="color:red;"><?php echo "$saldo"; ?></td>	
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
<div class="row" style="width:80%;">
<form id="movtienda" action = "movtienda.php" method = "get"> 
<div class="col-md-3">
<label>Fecha:</label>
<input type="date" id="fecha" name="fecha" min="2018-01-01" class="form-control input-sm chat-input" value='<?php echo $fecham;?>' required/>
</div>
<div class="col-md-2">
<label>Cuenta:</label> 
<select id="cuenta" name="cuenta" class="form-control input-sm chat-input">
<option value="1">Colpatria</option>
<option value="2">Bancolombia</option>
<option value="3">Efectivo</option>
</select><br>
</div>
<div class="col-md-2">
<label>Tipo:</label> 
<select id="tipologia" name="tipologia" class="form-control input-sm chat-input">
<option value="1">Entrada</option>
</select><br>
</div>
<div class="col-md-3">
<label>Valor:</label>
<input type="number" min="1" id="valor" name="valor" class="form-control input-sm chat-input"></input>
</div>
  <input type="hidden" id="idresidentes" name="idresidentes" value="<?php echo $idresidentes?>"></input>
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