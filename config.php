<?php 
$connect = mysqli_connect("localhost","root","","hypertec_venky");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();  
}

$api_key 	= 	'f83c9c294019f204db3cb108a7f0f0f4';
$api_token	=	'98680295941e9ec498e95d8121a5fbe2';

$category = array('mj'=>'Mystery Junkies', 'la'=>'Laser Adda','combo'=>'Combo');

?>