<?php
$fecha = date("y-m-d");
$hoy="20$fecha";
	
include_once('bas/conn.php');
include("menutienda.html");
mysqli_set_charset($con,"utf8");
?>
<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">
<center><h1>Reportes de ventas</h1></center><br><br>

    <form id="sumar" action = "resultados.php" method = "post" >

<div class="row ui-widget">	
<div class="col-md-3">
<label for="fechai">Fecha inicial</label><br>
<input type="date" id="fechai" name="fechai" value="<?php echo $hoy;?>" class="form-control input-sm chat-input" required/>
</div>
<div class="col-md-3">
<label for="fechaf">Fecha final</label><br>
<input type="date" id="fechaf" name="fechaf"  value="<?php echo $hoy;?>" class="form-control input-sm chat-input" required/>
</div>

<div class="col-md-4">
<label for="idclientes">Residente</label><br>
<select id="idclientes" name="idclientes" class="form-control input-sm chat-input">
<option value="0"></option>
<?php
$selectciudad=mysqli_query($con,"select * from residentes where estado ='A' or estado ='E' order by nombresr asc");
		while ($resultc = mysqli_fetch_array($selectciudad)) {
		$nombresr=$resultc['nombresr'];
		$apellidosr=$resultc['apellidosr'];
		$idresX=$resultc['idresidentes'];
		echo "<option value='$idresX'>$nombresr $apellidosr</option>";
		}
?>
</select>
</div>
<div class="col-md-2"><br>
<button type="submit" class="btn btn-primary">Buscar</button>          
</div>			
			
</div>
	</form>	
			
			
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