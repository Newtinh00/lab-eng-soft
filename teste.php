<?php
session_start();

if(!isset($_SESSION['id_usuario']))
{
    header("location: index.php");
    exit;
}
require_once 'classes/usuarios.php';
$u = new Usuario("app","localhost","root","");

date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "CSS/home.css">
    <link rel="stylesheet" href = "CSS/style.css">

    <title>Home</title>


    <link rel="stylesheet" type="text/css" href="CSS/slick.css">
    <link rel="stylesheet" type="text/css" href="CSS/slick-theme.css">

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



</head>
<body>
    <main>
        <div class="profiles">
        <?php

            $cards = $u->cards();
                   
            for ($i=0; $i<count($cards); $i++) {
        ?>
                <div class="profile"> 

                    <div class="profile__image">    
                            
        <?php
                            foreach ($cards[$i] as $key => $value){

                                $imagens = $u->buscaImagemCard($value);
                                ?>
								<ul class="slider">
                       
                                <?php

                                foreach ($imagens as $v){

                                    ?>
                                     <li>
                                    <?php
                                        foreach ($v as $k => $value ){
                                        	if ($value != null ) {
                                        	
                                        		?>

                                            	<img  width= "220px" height="300px" src="imagem/<?php echo $value;?>" >
                                    <?php      
                                        	}
                                         

                                                
                                        }
                                    ?>
                          			</li>
        <?php
                        
                    }
                }
          ?>
                        			

                                </ul>
          <?php   
        ?>              
                            
                         
                    </div>      
                </div>
        <?php
            }
        ?>
        </div>
      
</main>
<script src='js/hammer.min.js'></script>
<script src='js/main.js'></script>


    <script type="text/javascript">
        const img = document.querySelector('img')
        img.ondragstart = () => {
          return false;
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
$('.slider').slick();		
    </script>
    
</body>
</html>