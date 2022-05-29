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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "CSS/home.css">
    <link rel="stylesheet" href = "CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Home</title>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $('.carousel').carousel();
    </script>

</head>
<body>


    <div class="superior">
        <ul>
            <a href="meu_perfil.php"><li><ion-icon name="person-outline"></ion-icon></li></a>
            <a href=""><li><ion-icon name="chatbubble-outline"></ion-icon></li></a>
            <a href="AreaPrivada.php"><li><ion-icon class="active" name="home-outline"></ion-icon></li></a>
            <a href=""><li><ion-icon name="filter-outline"></ion-icon></li></a>
            <a href="settings.php"><li><ion-icon name="settings-outline"></ion-icon></li></a>
        </ul>
    </div>

    
    <div class="conteudo">

        <main>
            <div class="profiles">
                
                <?php

                    $cards = $u->cards();
                    $id_user = $_SESSION['id_usuario'];

                    for ($i=0; $i<count($cards); $i++) { 
                 ?>
                        <div class="profile">
                    <?php
                        foreach ($cards[$i] as $key => $value){
                            //if($key == 'id_usuario' && $value != $id_user){

                                if ($key == 'id_usuario' && $value != $id_user){
                        ?>
                                    <div class="profile__image" style="background-image: url('./imagem/leanbeef-soc-3.jpg');">
                                    </div>
                        <?php
                                    /*$imagens = $u->buscaImagem($value);

                                    for ($i=0; $i<count($imagens); $i++){ 
                                        foreach ($imagens[$i] as $key => $value){

                                            if($key == 'foto'){
                                                if($imagens[$i] >= $imagens[0]){
                        ?>                      
                                                <img class="" width= "220px" height="300px" src="./imagem/<?php echo $value?>">
                                                    
                        <?php
                                                }    
                                            }
                                        }
                                    }*/
                                }
                   
                                if ($key == 'nome') {
                        ?>          <div class="profile__infos">          
                                        <div class="profile__name"><?php echo $value.", "; ?>
                        <?php
                                }
                                if($key == 'dt_nascimento'){
                        ?> 
                                        <span class="profile__age"><?php 

                                            $dt_nascimento = date('Y-m-d', strtotime($value));
                                            $date = date('Y-m-d');
                                            $idade = date_diff(date_create($dt_nascimento), date_create($date));
                                           echo $idade->format('%y');
                                        ?></span>
                                        </div>
                    <?php
                                }
                            //}

                        }
                    ?>  
                           

                                        <div class="profile__description">Lindo</div>
                                    </div>
                        </div>
                 <?php
                    }

                ?>

            </div>

            <div class="bottombar">
              <div class="bottombar__button">
                <img src="imagem/icon-next.svg">
              </div>
              <div class="bottombar__button">
                <img src="imagem/icon-heart.svg">
              </div>
            </div>
        </main>
    </div>

    <script src='js/hammer.min.js'></script>
    <script src='js/main.js'></script>
</body>

</html>



