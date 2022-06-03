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
    <link rel="stylesheet" href = "CSS/home.css"> <!-- Home -->
    <link rel="stylesheet" href = "CSS/style.css"> <!-- Hammer.js -->
        <link rel="stylesheet" href = "CSS/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/slick.css"> <!-- Slick.js -->
    <link rel="stylesheet" type="text/css" href="CSS/slick-theme.css"><!-- Slick.js -->

    <script src="js/sweetalert2.min.js"></script>

    <title>Home</title>

    <!-- Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Fim Ionic Icons -->

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- FIm Bootstrap -->

    <!-- Hammer.js -->
    <script type="text/javascript">
        $('.carousel').carousel();
    </script>
    <!-- Fim Hammer.js -->
</head>
<body>

    <div class="superior">
        <ul>
            <li><a id="btn_option" href="javascript::" onclick="load_page('meu_perfil.php')"><ion-icon name="person"></ion-icon></a>
            </li>

            <li><a id="btn_option" href="javascript::" onclick="load_page()"><ion-icon name="chatbubble"></ion-icon></a></li>

            <li class="active"><a id="btn_option" href="home.php""><ion-icon class="active" name="home"></ion-icon></a></li>

            <li><a id="btn_option" href=""><ion-icon name="filter"></ion-icon> </a></li>

            <li><a id="btn_option" href="javascript::" onclick="load_page('settings.php')"><ion-icon name="settings"></ion-icon></a></li>
        </ul>
    </div>


    <div id="conteudo" class="conteudo">
        <main>

            <div class="profiles">
                <?php
                    $id_user = $_SESSION['id_usuario'];
                    $cards = $u->cards($id_user);
                    

                    for ($i=0; $i<count($cards); $i++) { 
                 ?>
                        <div class="profile">

                            <div class="profile__image">             
                            <?php

                            foreach ($cards[$i] as $key => $value){
                                if($value != $id_user){
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
                                                <img  width= "300px" height="450px" src="imagem/<?php echo $value;?>" >
                                        <?php      
                                            }
          
                                        }
                                        ?>
                                    </li>
        <?php
                        
                                 }

                                }
                            }
          ?>
                                </ul>                
                            </div>

                    <?php
                        foreach ($cards[$i] as $key => $value){
                            //if($key == 'id_usuario' && $value != $id_user){
                   
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
                           

                                        <div class="profile__description">
    
                                        
                                        </div>
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


    <!-- Bloquear o drag da imagem -->
    <script type="text/javascript">
        const img = document.querySelector('img')
        img.ondragstart = () => {
          return false;
        };
    </script>
    <!-- Fim Bloquear o drag da imagem -->

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Fim Jquery -->

    <!-- Slick.js -->
    <script src="js/slick.min.js"></script>

    <script type="text/javascript">
        $('.slider').slick();       
    </script>
    <!-- Fim Slick.js -->

    <!-- Ajax Sem refresh -->
    <script type="text/javascript">
        function load_page(arquivo){
            if(arquivo){

                $.ajax({
                    type: 'GET',
                    data: arquivo,
                    url: arquivo,
                    success: function(data){
                        $("#conteudo").html(data);
                    }
                });
            }
        }
    </script>
     <!-- Fim Ajax Sem refresh -->

    <!-- classe active dos botões do menu superior-->
    <script type="text/javascript">
        $(document).on('click', 'ul li', function(){
            $(this).addClass('active').siblings().removeClass('active')
        })
    </script>
    <!-- Fim classe active dos botões do menu superior--> 

    <script src='js/hammer.min.js'></script>
    <script src='js/main.js'></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</body>
</html>



