<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

$tablax=$_REQUEST['idt'];
$idtabla=$_REQUEST['idm'];
$idasiento=$_REQUEST['idas'];

if($tablax=='yuly'){$tablasel="Yuly";}
else if($tablax=='roca'){$tablasel="Jesús es mi roca";}
else if($tablax=='jorec'){$tablasel="Jorec";};

include("menusadmin.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

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
  <script>
  $( function() {
    var availableTags = [
      "ABONO PENSION",
	  "SALDO PENSION",
      "ABONO SUELDO",
      "COMPRA",
	  "DIEZMO",
      "LAVADA",
      "GRAVAMEN FINANCIERO",
      "PENSION",
      "TIENDA",
      "ALMUERZO",
      "GASOLINA",
      "SALE A CUENTA",
      "PRIMA",
      "COMIDA",
      "VACACIONES",
	  "HONORARIOS", 
	  "COMISIONES",
	  "ABONO TRANSPORTE DE RESIDENTES",
	  "SALDO TRANSPORTE DE RESIDENTES", 
	  "EMOLUMENTOS ECLESIASTICOS", 
	  "ARRENDAMIENTO",
	  "ENERGIA",
	  "MERCADO",
	  "MATERIALES", 
	  "SERVICIOS", 
	  "CONCENTRADO", 
	  "MANTENIMIENTO",
      "SUELDO",
      "LUZ",
      "PAGO",
      "RETEFUENTE",
      "RENTA",
      "DIVERSOS",	  
      "UNIFORMES",
	  "PARA CUADRAR BANCO",
      "VENTA",
	  "REGISTRO ANULADO",
      "NN",
	  "INGRESO SIN CORFIRMAR",	  
      "SUPONGO",
	  "CUOTA DE MANEJO"	  
	  ];
    $( "#concepto" ).autocomplete({
      source: availableTags
    });
  } );
  </script>

  <script type="text/javascript">
$(function() {
            $("#nombre").autocomplete({
			maxShowItems: 3,
                source: "actores.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
                    $('#idactores').val(ui.item.idactores);
					$('#nombre').val(ui.item.nombre);
			     }
            });
		});
</script>
<body>

<div class="container">
<div class="jumbotron">
<?php
$query="select * from $tablax join asientos on $tablax.idasientos=asientos.idasientos where id$tablax='$idtabla'";
$result=mysqli_query($con,"$query");
while ($resultx = mysqli_fetch_array($result)) {
$fecha=$resultx['fecha'];
$idtipologia=$resultx['idtipologia'];
$concepto=$resultx['concepto'];
$detalle=$resultx['detalle'];
$valorentrada=$resultx['valorentrada'];
$valorsalida=$resultx['valorsalida'];

if($idtipologia=='1'){$tiposel="Entrada";
$valor=$valorentrada;
}
else if($idtipologia=='2'){$tiposel="Salida";
$valor=$valorsalida;
}
}
?>
<form id="actmovimiento" action = "actmovimiento.php" method = "post">
<br>
<p>
<div class="row">

<div class="col-md-3">
<label>Movimiento contable fecha:</label>
<input type="date" id="fecha" name="fecha" class="form-control input-sm chat-input" value='<?php echo $fecha;?>' required/>
</div>

<div class="col-md-3">
<label>Tabla:</label>
<select id="tablax" name="tablax" class="form-control input-sm chat-input">
<option value='<?php echo $tablax;?>' selected><?php echo $tablasel;?></option>
<option value="roca">Jesús es mi roca</option>
<option value="jorec">Jorec</option>
<option value="yuly">Yuly</option>
</select><br>
</div>

<div class="col-md-3 ">
<label>Tipo:</label>
<select id="tipologia" name="tipologia" class="form-control input-sm chat-input">
<option value='<?php echo $idtipologia;?>' selected><?php echo $tiposel;?></option>
<option value="1">Entrada</option>
<option value="2">Salida</option>
</select><br>
</div>

<div class="col-md-3">
<label>Valor:</label>
<input type="number" min="0" id="valor" name="valor" class="form-control input-sm chat-input" 
value='<?php echo $valor;?>'></input>
</div>
</div>
</br>

<div class="row">

<div class="col-md-6"  class="ui-widget">
<label>Concepto:</label>
<input type="text" id="concepto" name="concepto" class="form-control input-sm chat-input" 
value='<?php echo $concepto;?>' style="text-transform: uppercase;"></input>
</div>

<div class="col-md-6">
<label>Detalle asociado:</label>
<input type="text" id="nombre" name="nombre" class="form-control input-sm chat-input" 
value='<?php echo $detalle;?>' style="text-transform: uppercase;"></input>
</div>
</div>
</br></br>

<input type="hidden" name="idas" id="idas" value='<?php echo $idasiento;?>'></input>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Guardar y continuar</button>          
</div>
</center>
</form>

</div>
</div>

<?php	
include("footersadmin.html");

}
else {
header("Location:index.php");
}
?>
</body>
</html>