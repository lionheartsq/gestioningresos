<?php
if (isset($_GET['term'])){

header('Content-type: application/json');
include_once('bas/conn.php');
@mysql_query("set names 'utf8'");

$sqlc="SELECT * FROM clientes where nif like '%" . $_GET['term'] . "%' LIMIT 0 ,50";
$selectc=@mysql_query($sqlc,$con);

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$resultc = array();
	while ($row = mysql_fetch_assoc($selectc)) {
		$row_array['value'] = $row['nif']." | ".$row['nombre'];
		$row_array['idclientes']=$row['id_clientes'];
		$row_array['nif']=$row['nif'];
		$row_array['nombre']=$row['nombre'];
		$row_array['direccion']=$row['direccion'];		
		$row_array['correo']=$row['correo'];
		array_push($resultc,$row_array);
}
echo json_encode($resultc);
}
?>