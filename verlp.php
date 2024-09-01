<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include_once('bas/conx.php');
include("menutienda.html");
mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 
$idproveedores=$_REQUEST['idresX'];
?>

<div class="container">
<div class="jumbotron">

<?php
$query="select nombre from proveedores where idproveedores='$idproveedores';";
$result=mysqli_query($con,$query);
while ($resultax = mysqli_fetch_array($result)) {
$nomprov=$resultax['nombre'];
}
?>
<center><h2><?php echo $nomprov; ?></h2></center>
<?php
$queryp="select * from pedidos where idproveedores='$idproveedores' order by fecha asc";	
$resultp=mysqli_query($conx,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$fechafra=$resultxp['fecha'];
$fra=$resultxp['documento'];
$valorfra=$resultxp['total'];
$idpedidos=$resultxp['idpedidos'];
//new
$acumpagofl=0;
$acumabfl=0;
$saldofl=0;

$queryfl="select * from pagos where idpedidos='$idpedidos' order by fechaabono asc";	
$resultfl=mysqli_query($conx,$queryfl);

while ($resultxfl = mysqli_fetch_array($resultfl)) {
$abonofl=$resultxfl['abono'];
$valorpagofl=$resultxfl['valorpago'];
$acumpagofl=$acumpagofl+$valorpagofl;
$acumabfl=$acumabfl+$abonofl;
$saldofl=$acumpagofl-$acumabfl;
}
//echo $queryfl;
//echo "<br>";
//echo $saldofl;
if($saldofl!=0){
?>
<center><h2><?php echo "Movimientos factura: ".$fra; ?></h2></center><br>
<center>
<div class="table-responsive">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Fecha</th>
<th>Valor fra</th>
<th>Abono fra</th>
<th>Saldo</th>
    </tr>
</thead>
<tbody>

<?php
$queryu="select * from pagos where idpedidos='$idpedidos' order by fechaabono asc";	
$result1=mysqli_query($conx,$queryu);
$acumab=0;

while ($resultx = mysqli_fetch_array($result1)) {
$idpagos=$resultx['idpagos'];
$fechaabono=$resultx['fechaabono'];
$abono=$resultx['abono'];
$acumab=$acumab+$abono;
$saldo=$valorfra-$acumab;
?>
<tr>
<td><a href='editaproveedor.php?idpa=<?php echo "$idpagos";?>'><?php echo "$fechaabono"; ?></a></td>
<td><?php echo "$valorfra"; ?></td>
<td style="color:green;"><?php echo "$abono"; ?></td>
<td style="color:red;"><?php echo "$saldo"; ?></td>	
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
<form id="movtienda" action = "movproveedores.php" method = "get"> 
<div class="col-md-3">
<label>Fecha:</label>
<input type="date" id="fecha" name="fecha" min="2018-05-02" class="form-control input-sm chat-input" value='<?php echo $fecham;?>' required/>
</div>
<div class="col-md-3">
<label>Tipo:</label> 
<select id="tipologia" name="tipologia" class="form-control input-sm chat-input">
<option value="2">Pago Colpatria</option>
<option value="1">Pago Bancolombia</option>
<option value="3">Pago efectivo</option>
<!-- <option value="1">Entrada</option> -->
</select><br>
</div>
<div class="col-md-4">
<label>Valor:</label>
<input type="number" min="1" id="valor" name="valor" class="form-control input-sm chat-input"></input>
</div>
<input type="hidden" id="idpedidos" name="idpedidos" value="<?php echo $idpedidos?>"></input>
<input type="hidden" id="idproveedores" name="idproveedores" value="<?php echo $idproveedores?>"></input>

<div class="wrapper col-md-2"><br>
<button type="submit" class="btn btn-danger">Ingresar abono</button>          
</div>
</form>
</div></center>

<?php
}
}
?>

</div>
</div>
<?php
include("footersadmin.html");
?>
