<?php
if (isset($_GET['term'])){

header('Content-type: application/json');
include_once('bas/conx.php');
mysqli_set_charset($conx,"utf8");

$sql="SELECT * FROM productos where plu like '%" . $_GET['term'] . "%'";
$select=mysqli_query($conx,$sql);

/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$result = array();
while($data = mysqli_fetch_assoc($select)) {

$idprox=$data['idproductos'];
$plux=$data['plu'];
	
$queryxinv="SELECT SUM(cantidad) as inventariox FROM detalleingreso 
join productos on detalleingreso.idproductos=productos.idproductos 
where productos.idproductos='$idprox'";

$resultxinv=mysqli_query($conx,$queryxinv);
while ($resultaxinv = mysqli_fetch_array($resultxinv)) {
$inventariox=$resultaxinv['inventariox'];
}

$queryxven="SELECT cantidad as ventasx FROM detallefactura 
join productos on detallefactura.idproductos=productos.idproductos 
where productos.idproductos='$idprox'";


$stocku=$inventariox-$ventasx;

		$row_array['value'] = $data['detalle']." | $".$data['pvp']." | Disponible:".$stocku;
		$row_array['cod']=$data['plu'];
		$row_array['detalle']=$data['detalle'];
		$row_array['precio']=$data['pvp'];
		$row_array['idproductos']=$data['idproductos'];

		array_push($result,$row_array);
}
echo json_encode($result);
}
?>