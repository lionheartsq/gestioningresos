<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<?php
include_once('bas/conx.php');

mysqli_set_charset($conx,"utf8");
	
$result=mysqli_query($conx,"SELECT r.idproductos,r.plu,r.detalle from productos r where r.estado='1' order by detalle;");

$ordinal=0;
?>
<!-- <body onload="window.print();"> -->
<body>
	<div style="margin-left: 5%">
		<?php
		include 'barcode128.php';

	while ($resultc = mysqli_fetch_array($result)) {
		$documento=$resultc['plu'];
		$nombre=$resultc['detalle'];

			echo "<p class='inline'><span ><b>".$nombre." </b><span>".bar128(stripcslashes($documento))."</p>&nbsp&nbsp&nbsp&nbsp";
		}

		?>
	</div>
</body>
</html>