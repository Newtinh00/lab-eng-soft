<?php 

require_once 'classes/usuarios.php';
$u = new Usuario("app","localhost","root","");

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>teste</title>
</head>
<body>

<form action="teste2.php" method="POST">

	<?php
              
        $dados = $u->buscaInteresse();

        for ($i=0; $i<count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value){
    ?> 
             	<label>
             		 
		           	<?php
	           			if($key != 'id_interesse'){
		           			echo $value;
		           		}

		           		if($key == 'id_interesse'){
						?>
		           			<input type="checkbox" name="interesses[]" value="<?php echo $value;?>">
		           		<?php
		           		}
					
		           	?>

           		</label>
    <?php
            }   
        }  
    ?>   
         <button type="submit" name="save">save</button>
</form>

	

</body>
</html>