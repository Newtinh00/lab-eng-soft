<?php 
session_start();
 

require_once 'classes/usuarios.php';
$u = new Usuario("app","localhost","root","");

if (isset($_POST['savet'])) {

 	$interesses =  $_POST['interesses'];

	foreach ($interesses as $item) {

		echo $item. "<br>";
	}
 	

 } 




 ?>

