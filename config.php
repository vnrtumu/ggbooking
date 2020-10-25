<?php 
// $connect = mysqli_connect("localhost","root","","hypertec_venky");

$connect = mysqli_connect("bskhiboo9bogot0zbdcb-mysql.services.clever-cloud.com","urafqi6yoms5du3c","rP4VT6VBgYikfr29z80y","bskhiboo9bogot0zbdcb");




// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();  
}

$api_key 	= 	'test_409cf93b1161cde95b03f898c4b';
$api_token	=	'test_83cb954247532b1b14f7c305657';

$category = array('mj'=>'Mystery Junkies', 'la'=>'Laser Adda','combo'=>'Combo');

?>