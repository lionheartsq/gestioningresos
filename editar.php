<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

$residente=$_REQUEST["idr"];

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

<body>

<div class="container">
<div class="jumbotron">
<p><center><h2><u>Formulario de Ingreso del Residente</u></h2></center></p><br>
<form id="editarresidente" action = "editarres.php" method = "post">

<?php
$result1=mysqli_query($con,"select residentes.idresidentes as idresidentes, residentes.documentor as documentor, residentes.expedicionr as expedicionr, residentes.fechanacimiento as fechanacimiento, residentes.nombresr as nombresr, residentes.apellidosr as apellidosr, residentes.telefono as telefonor, residentes.celular as celularr, residentes.profesion as profesionr, residentes.email as emailr, residentes.estado as estador, residentes.direccionf as direccionr, residentes.ciudad as ciudadr, residentes.estudios as estudiosr, residentes.estadocivil as estadocivilr, residentes.conyuge as conyuger, residentes.tipodocumento as tipodocumentor, residentes.eps as eps, residentes.padre as padrer, residentes.madre as madrer, residentes.nomfund as nomfund, historial.idhistorial as idhistorial, historial.fechaingreso as fechaingresoh, historial.motivoi as motivoi, historial.tiempoadiccion as tiempoadiccion, historial.medidatiempo as medidatiempo, historial.drogasusadas as drogasusadas, historial.problemas as problemas, historial.carcel as carcel, historial.fundaciones as fundaciones, historial.motivos as motivos, historial.referido as referido, historialm.idhistorialm as idhistorialm, 
historialm.enfermedades as enfermedades, historialm.fechaexamen as fechaexamen, historialm.estadosalud as estadosalud, 
historialm.vacunas as vacunas, historialm.diagnosis as diagnosis, historialm.medicamentos as medicamentos, historialm.alergias as alergias, historialm.hospitalizado as hospitalizado, historialm.descripcion as descripcion, asociacion.idasociacion as idasociacion, asociacion.idusuarios as idusuarios, asociacion.parentesco as parentesco, usuarios.documento as documentou, usuarios.expedicion as expedicionu, usuarios.nombres as nombresu, usuarios.apellidos as apellidosu, usuarios.telefono as telefonou, usuarios.email as emailu, usuarios.autorizacion as autorizacion from residentes join historial on historial.idresidentes=residentes.idresidentes join historialm on historialm.idresidentes=residentes.idresidentes join asociacion on asociacion.idresidentes = residentes.idresidentes join usuarios on asociacion.idusuarios = usuarios.idusuarios where residentes.idresidentes='$residente'");

while ($resultx = mysqli_fetch_array($result1)) {
$idr=$resultx['idresidentes'];
$documentor=$resultx['documentor'];
$expedicionr=$resultx['expedicionr'];
$fechan=$resultx['fechanacimiento'];
$nomres=$resultx['nombresr'];
$apres=$resultx['apellidosr'];
$telefonor=$resultx['telefonor'];
$celularr=$resultx['celularr'];
$profesionr=$resultx['profesionr'];
$emailr=$resultx['emailr'];
$estador=$resultx['estador'];
$direccionr=$resultx['direccionr'];
$ciudadr=$resultx['ciudadr'];
$estudiosr=$resultx['estudiosr'];
$estadocivilr=$resultx['estadocivilr'];
$conyuger=$resultx['conyuger'];
$tipodocr=$resultx['tipodocumentor'];
$eps=$resultx['eps'];
$padrer=$resultx['padrer'];
$madrer=$resultx['madrer'];
$nomfund=$resultx['nomfund'];
$idhistorial=$resultx['idhistorial'];
$fechai=$resultx['fechaingresoh'];
$motivoi=$resultx['motivoi'];
$tiempoadiccion=$resultx['tiempoadiccion'];
$medidatiempo=$resultx['medidatiempo'];
$drogasusadas=$resultx['drogasusadas'];
$problemas=$resultx['problemas'];
$carcel=$resultx['carcel'];
$fundaciones=$resultx['fundaciones'];
$motivos=$resultx['motivos'];
$referido=$resultx['referido'];
$idhistorialm=$resultx['idhistorialm'];
$enfermedades=$resultx['enfermedades'];
$fechaexamen=$resultx['fechaexamen'];
$estadosalud=$resultx['estadosalud'];
$vacunas=$resultx['vacunas'];
$diagnosis=$resultx['diagnosis'];
$medicamentos=$resultx['medicamentos'];
$alergias=$resultx['alergias'];
$hospitalizado=$resultx['hospitalizado'];
$descripcion=$resultx['descripcion'];
$idasociacion=$resultx['idasociacion'];
$idusuarios=$resultx['idusuarios'];
$parentesco=$resultx['parentesco'];
$documentou=$resultx['documentou'];
$expedicionu=$resultx['expedicionu'];
$nombresu=$resultx['nombresu'];
$apellidosu=$resultx['apellidosu'];
$telefonou=$resultx['telefonou'];
$emailu=$resultx['emailu'];
$autorizacion=$resultx['autorizacion'];
?>

<p><select id="nomfund" name="nomfund" class="form-control input-sm chat-input">
<option value="<?php echo $nomfund; ?>"><?php echo $nomfund; ?></option>
<option value="F">FUNDACIÓN JESÚS ES MI ROCA</option>
<option value="J">CENTRO JOREC</option>
<option value="EF">-*-FUNDACIÓN JESÚS ES MI ROCA-*-</option>
<option value="EJ">-*-CENTRO JOREC-*-</option>
</select><br>
<p>
<div class="row">
<div class="col-md-6">
<label>Fecha de ingreso:</label>
<input type="date" id="fechai" name="fechai" class="form-control input-sm chat-input" value='<?php echo $fechai;?>' required/>
</div>
<div class="col-md-6">
<label>Ingresa a:</label>
<input type="text" id="motivoi" name="motivoi" class="form-control input-sm chat-input" value='<?php echo $motivoi;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-6">
<label>Nombres:</label>
<input type="text" id="nomres" name="nomres" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del nuevo residente" value='<?php echo $nomres;?>'></input></div>
<div class="col-md-6">
<label>Apellidos:</label>
<input type="text" id="apres" name="apres" class="form-control input-sm chat-input" placeholder="Ingrese los apellidos del nuevo residente"value='<?php echo $apres;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<label>Fecha de nacimiento:</label>
<input type="date" id="fechan" name="fechan" value='<?php echo $fechan;?>' class="form-control input-sm chat-input" required/>
</div>
<div class="col-md-4">
<label>Seguro social:</label>
<input type="text" id="eps" name="eps" class="form-control input-sm chat-input" value='<?php echo $eps;?>'></input>
</div>
<div class="col-md-4">
<label>Número documento:</label>
<input type="number" id="documentor" name="documentor" class="form-control input-sm chat-input" 
value='<?php echo $documentor;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<label>Expedido en:</label>
<select id="expedicionr" name="expedicionr" class="form-control input-sm chat-input">
  <option value='<?php echo $expedicionr;?>' selected><?php echo $expedicionr;?></option>
<?php
$selectciudad=mysqli_query($con,"select DETALLE_CIUDADES as ciudad FROM ciudades order by DETALLE_CIUDADES asc");
		while ($resultc = mysqli_fetch_array($selectciudad)) {
		$sciudad=$resultc['ciudad'];
		echo "<option value='$sciudad'>$sciudad</option>";
		}
?>
</select>
</div>
<div class="col-md-1">
<label>Tipo:</label>
<select id="tipodocr" name="tipodocr" class="form-control input-sm chat-input">
<option value='<?php echo $tipodocr;?>' selected><?php echo $tipodocr;?></option>
<option value="T.I">T.I</option>
<option value="C.C">C.C</option>
<option value="C.C">R.C</option>
</select></div>
<div class="col-md-3">
<label>Teléfono fijo:</label>
<input type="text" id="telefonor" name="telefonor" class="form-control input-sm chat-input" 
value='<?php echo $telefonor;?>'></input>
</div>
<div class="col-md-4">
<label>Celular:</label>
<input type="text" id="celularr" name="celularr" class="form-control input-sm chat-input" 
value='<?php echo $celularr;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-8">
<label>Dirección:</label>
<input type="text" id="direccionr" name="direccionr" class="form-control input-sm chat-input" 
value='<?php echo $direccionr;?>'></input></div>
<div class="col-md-4">
<label>Ciudad:</label>
<select id="ciudadr" name="ciudadr" class="form-control input-sm chat-input">
  <option value='<?php echo $ciudadr;?>' selected><?php echo $ciudadr;?></option>
<?php
$selectciudad2=mysqli_query($con,"select DETALLE_CIUDADES as ciudad FROM ciudades order by DETALLE_CIUDADES asc");
		while ($resultc2 = mysqli_fetch_array($selectciudad2)) {
		$sciudad2=$resultc2['ciudad'];
		echo "<option value='$sciudad2'>$sciudad2</option>";
		}
?>
</select>
</div>
</div>
<br>

<div class="row">
<div class="col-md-2">
<label>Estudios:</label>
<select id="estudiosr" name="estudiosr" class="form-control input-sm chat-input">
<option value='<?php echo $estudiosr;?>' selected><?php echo $estudiosr;?></option>
<option value="Ninguno">Ninguno</option>
<option value="1°">1°</option>
<option value="2°">2°</option>
<option value="3°">3°</option>
<option value="4°">4°</option>
<option value="5°">5°</option>
<option value="6°">6°</option>
<option value="7°">7°</option>
<option value="8°">8°</option>
<option value="9°">9°</option>
<option value="10°">10°</option>
<option value="11°">11°</option>
<option value="Superior">Superior</option>
</select></div>
<div class="col-md-5">
<label>Profesión u oficio:</label>
<input type="text" id="profesionr" name="profesionr" class="form-control input-sm chat-input" 
value='<?php echo $profesionr;?>'></input>
</div>
<div class="col-md-5">
<label>Correo electrónico:</label>
<input type="e-mail" id="emailr" name="emailr" class="form-control input-sm chat-input" 
value='<?php echo $emailr;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-3">
<label>Estado civil:</label>
<select id="estadocivilr" name="estadocivilr" class="form-control input-sm chat-input">
<option value='<?php echo $estadocivilr;?>'><?php echo $estadocivilr;?></option>
<option value="Soltero">Soltero</option>
<option value="Casado">Casado</option>
<option value="Separado">Separado</option>
<option value="Unión libre">Unión libre</option>
</select></div>
<div class="col-md-9">
<label>Nombre del cónyuge:</label>
<input type="text" id="conyuger" name="conyuger" class="form-control input-sm chat-input" 
value='<?php echo $conyuger;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-6">
<label>Nombre del padre:</label>
<input type="text" id="padrer" name="padrer" class="form-control input-sm chat-input" 
value='<?php echo $padrer;?>'></input></div>
<div class="col-md-6">
<label>Nombre de la madre:</label>
<input type="text" id="madrer" name="madrer" class="form-control input-sm chat-input" value='<?php echo $madrer;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-2">
<label>Tiempo en la adicción:</label>
<div class="row">
<div class="col-md-5">
<input type="number" id="tiempoadiccion" name="tiempoadiccion" class="form-control input-sm chat-input" 
value='<?php echo $tiempoadiccion;?>'></input>
</div>
<div class="col-md-7">
<select id="medidatiempo" name="medidatiempo" class="form-control input-sm chat-input">
<option value='<?php echo $medidatiempo;?>' selected><?php echo $medidatiempo;?></option>
<option value="Dias">Dias</option>
<option value="Semanas">Semanas</option>
<option value="Meses">Meses</option>
<option value="Años">Años</option>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<label>Drogas usadas:</label>
<input type="text" id="drogasusadas" name="drogasusadas" class="form-control input-sm chat-input" 
value='<?php echo $drogasusadas;?>'></input>
</div>
<div class="col-md-2">
<label>Problemas con la justicia:</label>
<select id="problemas" name="problemas" class="form-control input-sm chat-input">
<option value='<?php echo $problemas;?>' selected><?php echo $problemas;?></option>
<option value="No">No</option>
<option value="Si">Si</option>
</select>
</div>
<div class="col-md-2">
<label>Ha estado preso:</label>
<select id="carcel" name="carcel" class="form-control input-sm chat-input">
<option value='<?php echo $carcel;?>' selected><?php echo $carcel;?></option>
<option value="No">No</option>
<option value="Si">Si</option>
</select>
</div>
</div>
<br>

<div class="row">
<div class="col-md-5">
<label>Fundaciones en las que ha estado:</label>
<input type="text" id="fundaciones" name="fundaciones" class="form-control input-sm chat-input" 
value='<?php echo $fundaciones;?>'></input></div>
<div class="col-md-4">
<label>Motivos del retiro:</label>
<input type="text" id="motivos" name="motivos" class="form-control input-sm chat-input" value='<?php echo $motivos;?>'></input>
</div>
<div class="col-md-3">
<label>Cómo se enteró de nosotros:</label>
<input type="text" id="referido" name="referido" class="form-control input-sm chat-input" 
value='<?php echo $referido;?>'></input>
</div>
</div>
<br>
</p>
<p><center><h2><u>Información del acudiente</u></h2></center></p><br>
<p>

<div class="row">
<div class="col-md-6">
<label>Nombres:</label>
<input type="text" id="nombresu" name="nombresu" class="form-control input-sm chat-input" 
value='<?php echo $nombresu;?>'></input></div>
<div class="col-md-6">
<label>Apellidos:</label>
<input type="text" id="apellidosu" name="apellidosu" class="form-control input-sm chat-input" 
value='<?php echo $apellidosu;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<label>Número documento:</label>
<input type="number" id="documentou" name="documentou" class="form-control input-sm chat-input" 
value='<?php echo $documentou;?>'></input>
</div>
<div class="col-md-4">
<label>Expedido en:</label>
<select id="expedicionu" name="expedicionu" class="form-control input-sm chat-input">
  <option value='<?php echo $expedicionu;?>' selected><?php echo $expedicionu;?></option>
<?php
$selectciudad=mysqli_query($con,"select DETALLE_CIUDADES as ciudad FROM ciudades order by DETALLE_CIUDADES asc");
		while ($resultc = mysqli_fetch_array($selectciudad)) {
		$sciudad=$resultc['ciudad'];
		echo "<option value='$sciudad'>$sciudad</option>";
		}
?>
</select>
</div>
<div class="col-md-4">
<label>Teléfono:</label>
<input type="number" id="telefonou" name="telefonou" class="form-control input-sm chat-input" 
value='<?php echo $telefonou;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<label>Correo:</label>
<input type="text" id="emailu" name="emailu" class="form-control input-sm chat-input" value='<?php echo $emailu;?>'></input>
</div>
<div class="col-md-4">
<label>Parentesco con el residente:</label>
<input type="text" id="parentesco" name="parentesco" class="form-control input-sm chat-input" 
value='<?php echo $parentesco;?>'></input>
</div>
<div class="col-md-4">
<label>Autorización:</label>
<select id="autorizacion" name="autorizacion" class="form-control input-sm chat-input">

<option value='<?php echo $autorizacion;?>'><?php echo $autorizacion;?> autorizo el uso de imágenes en diversos medios.</option>
<option value="SI">SI autorizo el uso de imágenes en diversos medios.</option>
<option value="NO">NO autorizo el uso de imágenes en diversos medios.</option>
</select>
</div>
</div>
<br>
</p>

<p><center><h2><u>Historia médica</u></h2></center></p><br>
<p>

<div class="row">
<div class="col-md-9">
<label>¿Padece el residente alguna enfermedad?:</label>
<input type="text" id="enfermedades" name="enfermedades" class="form-control input-sm chat-input" 
value='<?php echo $enfermedades;?>'></input>
</div>
<div class="col-md-3">
<label>Fecha de último exámen físico:</label>
<input type="date" id="fechaexamen" name="fechaexamen" class="form-control input-sm chat-input" value='<?php echo $fechaexamen;?>'>
</div>
</div>
<br>

<div class="row">
<div class="col-md-3">
<label>¿Cómo califica su salud en general?:</label>
<select id="estadosalud" name="estadosalud" class="form-control input-sm chat-input">
<option value='<?php echo $estadosalud;?>'><?php echo $estadosalud;?></option>
<option value="Excelente">Excelente</option>
<option value="Buena">Buena</option>
<option value="Regular">Regular</option>
<option value="Pobre">Pobre</option>
</select></div>
<div class="col-md-3">
<label>¿Tiene sus vacunas al dia?:</label>
<select id="vacunas" name="vacunas" class="form-control input-sm chat-input">
<option value='<?php echo $vacunas;?>'><?php echo $vacunas;?></option>
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</div>
<div class="col-md-6">
<label>Diagnóstico por el médico:</label>
<input type="text" id="diagnosis" name="diagnosis" class="form-control input-sm chat-input" 
value='<?php echo $diagnosis;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-6">
<label>¿Toma algún medicamento?:</label>
<input type="text" id="medicamentos" name="medicamentos" class="form-control input-sm chat-input" 
value='<?php echo $medicamentos;?>'></input>
</div>
<div class="col-md-6">
<label>¿Tiene alergias?:</label>
<input type="text" id="alergias" name="alergias" class="form-control input-sm chat-input" 
value='<?php echo $alergias;?>'></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-12">
<label>¿Ha estado hospitalizado?:</label>
<span>
<select id="hospitalizado" name="hospitalizado"/>
<option value='<?php echo $hospitalizado;?>' selected><?php echo $hospitalizado;?></option>
<option value="Si">Si</option><option value="No">No</option></select>
<input type="text" id="hospitald" name="hospitald" class="form-control input-sm chat-input" 
value='<?php echo $descripcion;?>'/>
</span>
</div>
</div>
<br>

</p>
<?php
}
?>

<input type="hidden" id="idr" name="idr" value="<?php echo $idr;?>"></input>
<input type="hidden" id="idhistorial" name="idhistorial" value="<?php echo $idhistorial;?>"></input>
<input type="hidden" id="idhistorialm" name="idhistorialm" value="<?php echo $idhistorialm;?>"></input>
<input type="hidden" id="idasociacion" name="idasociacion" value="<?php echo $idasociacion;?>"></input>
<input type="hidden" id="idusuarios" name="idusuarios" value="<?php echo $idusuarios;?>"></input>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Actualizar datos</button>          
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