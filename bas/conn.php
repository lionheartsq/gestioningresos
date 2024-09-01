<?php
/**/
$db_host = 'localhost'; //hostname
$db_user = 'root'; // username
$db_password = ""; // password
$db_name = 'gestioningresos'; //database name



//El host está mal, pon 62.72.50.63 o srv1107.hstgr.io
/*
$db_host = 'srv1107.hstgr.io'; //hostname
$db_user = 'u727327027_fyuly'; // username
$db_password = "squall78"; // password
$db_name = 'u727327027_fjemr'; //database name
*/

$con = mysqli_connect($db_host,$db_user,$db_password,$db_name);
?>
