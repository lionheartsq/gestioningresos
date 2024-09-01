<?php
	$cedula=$_REQUEST['user'];

	$pass=MD5($_REQUEST['pass']);

	//$pass=$_REQUEST['pass'];

	include_once('bas/conn.php');

	mysqli_set_charset($con,"utf8");

	$query="select * from validacion join usuarios on validacion.idusuarios=usuarios.idusuarios 
	where usuarios.documento='$cedula' and validacion.password='$pass'";
	
	$result=mysqli_query($con,"$query");
	
	if(mysqli_num_rows($result)>0){
			while ($resultx = mysqli_fetch_array($result)) {
			$rol=$resultx['idroles'];
			$cedula=$resultx['documento'];
			$nombre=$resultx['nombres'];
			$apellido=$resultx['apellidos'];
			$clave=$resultx['idusuarios'];			
			}
		}	
    if($rol=='3'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["admin"]=true;
	
		header("Location:tienda.php");	
	}
	else{
		header("Location:index.php?flag=1");
	}
	 
	mysqli_close($con);
?>