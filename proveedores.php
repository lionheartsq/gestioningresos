<?php
if (isset($_GET['term'])){

header('Content-type: application/json');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$sqld="SELECT * FROM proveedores where nombre like '%" . $_GET['term'] . "%' and estado='1' LIMIT 0 ,50";
$selectd=mysqli_query($con,$sqld);

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$resultd = array();
	while ($row = mysqli_fetch_assoc($selectd)) {
		$row_array['value'] = $row['nombre'];
		$row_array['idproveedores']=$row['idproveedores'];
		$row_array['nombre']=$row['nombre'];
		array_push($resultd,$row_array);
}
echo json_encode($resultd);
}
?>