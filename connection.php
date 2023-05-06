<?php

$dbserver = "localhost";
$dbuser = "root";
$password = "";
$dbname = "startupexpo";


$link = mysqli_connect($dbserver, $dbuser, $password, $dbname);
 

if($link == false){
	echo "Could not connect";
   
}


?>

