<?php
session_start();
if(!isset($_SESSION['id_usuario']))
{
    header("location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "CSS/interesses.css">
    <title>SEJA BEM VINDO MEU(INHA) CONSAGRADO!!</title>
</head>
<body>
Area exclusiva para namoradores
</body>
</html>



<a href="index.php"> Sair </a>