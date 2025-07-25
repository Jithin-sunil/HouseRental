<?php
$Server="localhost";
$User="root";
$Password="";
$Db="db_houserental";
$Con=mysqli_connect($Server,$User,$Password,$Db);
if(!$Con)
{
	echo "connection error";
}
?>