<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");
?>
<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">

<div class="table-responsive">
<table id="tabla" class="display" cellspacing="0" width="100%">

<thead>
    <tr>
<th>Fecha ingreso</th>
<th>Documento</th>
<th>Practicante</th>
<th>Eps</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Observaciones</th>
<th>Estado</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha ingreso</th>
<th>Documento</th>
<th>Practicante</th>
<th>Eps</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Observaciones</th>
<th>Estado</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select practicantes.idpracticantes as idr,practicantes.documentop as cedr,practicantes.nombresp as nomr,practicantes.apellidosp as apelr,practicantes.telefono as telefono,practicantes.email as email,practicantes.eps as eps,
practicantes.estado as estr,historialp.fechaingreso as fechain,historialp.observaciones as observaciones from practicantes join historialp on practicantes.idpracticantes=historialp.idpracticantes order by nomr asc");

while ($resultx = mysqli_fetch_array($result1)) {
$idr=$resultx['idr'];
$cedr=$resultx['cedr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$estr=$resultx['estr'];
$eps=$resultx['eps'];
$telefono=$resultx['telefono'];
$email=$resultx['email'];
$fechain=$resultx['fechain'];
$observaciones=$resultx['observaciones'];

if($estr==="A"){
$estad="Activo";	
}
else{
$estad="Inactivo";	
}
?>
<tr>
<td><?php echo "$fechain"; ?></td>
<td><?php echo "$cedr"; ?></td>
<td><?php echo "$nomr"." "."$apelr"; ?></td>
<td><?php echo "$eps"; ?></td>
<td><?php echo "$telefono"; ?></td>
<td><?php echo "$email"; ?></td>
<td><?php echo "$observaciones"; ?></td>
<td><?php echo "<a href='cambiarep.php?idr=$idr&estado=$estr'>$estad</a>"; ?></td>
</tr>
<?php
}
?>

</tbody>

</table>
</div>

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
}
else {
header("Location:index.php");
}
?>