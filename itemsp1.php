<?php
if (isset($_GET['term'])){

header('Content-type: application/json');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$sql="SELECT * FROM productos join impuesto on productos.idimpuesto=impuesto.idimpuesto where detalle like '%" . $_GET['term'] . "%' LIMIT 0 ,50";
$select=mysqli_query($con,$sql);

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$result = array();
while($data = mysqli_fetch_assoc($select)) {
        $row_array['value'] = $data['plu']." | ".$data['detalle']." | Precio compra: $".$data['valorcompra'];
		$row_array['codp']=$data['plu'];
		$row_array['comercialp']=$data['comercial'];
		$row_array['detallep']=$data['detalle'];
		$row_array['preciop']=$data['valorcompra'];
		$row_array['unidades']=$data['unidades'];
		$row_array['impuestop']=$data['valor'];
		$row_array['idproductos']=$data['idproductos'];

		array_push($result,$row_array);
}
echo json_encode($result);
}
?>