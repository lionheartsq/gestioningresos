<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

include_once('bas/conn.php');

$iduniformes=$_REQUEST['iduniformes'];
$fechaa=$_REQUEST['fechaa'];
$valora=$_REQUEST['valora'];

mysqli_set_charset($con,"utf8");
$query="INSERT INTO abonouniformes(fechaabono,abono,iduniformes) 
VALUES ('$fechaa','$valora','$iduniformes')";
$result=mysqli_query($con,$query);
echo "$query";
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


<?php	
header("Location:labonosu.php?id=$iduniformes");

}
else {
header("Location:index.php");
}
?>