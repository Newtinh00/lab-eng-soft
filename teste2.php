<?php 

session_start();
 

if (isset($_POST['save'])) {
 	

 	$interesses =  $_POST['interesses'];

	foreach ($interesses as $item) {
		echo $item . "<br>";
	}
 	

 } 




 ?>

