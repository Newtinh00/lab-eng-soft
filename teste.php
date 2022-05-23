<?php 
require_once 'classes/usuarios.php';
$u = new Usuario("app","localhost","root","");

if (isset($_POST['submit'])) {
	$contadorImagem = count($_FILES['image']['name']);
	for ($i=0; $i < $contadorImagem ; $i++) { 

		$imageName = $_FILES['image']['name'][$i];
		$imageTempName = $_FILES['image']['tmp_name'][$i];
		$targetPath ="./imagem/". $imageName;

		if(move_uploaded_file($imageTempName, $targetPath)){
			$u->insereFoto($imageName);
		}
	}
}

 ?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>teste</title>
	</head>
	<body>

	 <form action="teste.php" method="POST" enctype="multipart/form-data">

	 	 <input type="file" name="image[]" multiple> <br><br>
	 	 <input type="submit" name="submit" value="upload">
	 </form>
		

	</body>
</html>