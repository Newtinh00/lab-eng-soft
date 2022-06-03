<?php
session_start();

if(!isset($_SESSION['id_usuario']))
{
    header("location: AreaPrivada.php");
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
    <link rel="stylesheet" href = "CSS/sweetalert2.min.css">
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


    

    <div id="conteudo" class="conteudo">

        <main>
            <div class="meu_perfil">
                <div class="foto">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                        <?php
                             $id_user = $_SESSION['id_usuario']; 
                             $imagens = $u->buscaImagem($id_user);

                            for ($i=0; $i<count($imagens); $i++) { 
                                foreach ($imagens[$i] as $key => $value){
                                    if($key == 'foto'){
                                        if($imagens[$i] == $imagens[0]){
                        ?>
                                            <div class="carousel-item active">
                                                <img class="" width= "320px" height="400px" src="./imagem/<?php echo $value?>">
                                            </div>
                        <?php
                                        }else if($imagens[$i] >= $imagens[1]){
                        ?>
                                            <div class="carousel-item">
                                                <img class="" width= "320px" height="400px" src="./imagem/<?php echo $value?>">
                                            </div>
                        <?php
                                       } 
                                    }
                                }
                            }

                        ?>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>

                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>
                </div>


                <div class="info">
                    <div class="primeiro_dado">
                        <h1 class="font-h1">
                            <?php
                                 $id_user = $_SESSION['id_usuario']; 
                                 $dados = $u->buscaDados($id_user);

                                    for ($i=0; $i<count($dados); $i++) { 
                                        foreach ($dados[$i] as $key => $value){
                                            if($key == 'nome'){
                                                echo $value;
                                            }
                                        }
                                    }
                            ?>
                        </h1>
                        <h2 class="font-h2">
                            <?php 
                               $idade = $u->calculaData($id_user);
                                        foreach ($idade as $key => $value){
                                            
                                                echo ", ".$value;
                                        } 
                            ?>
                        </h2>
                    </div>
                        <h4 class="font-h4">
                            <ion-icon name="school-outline"></ion-icon>Escolaridade
                        </h4>
                        <h4 class="font-h4">
                            <ion-icon name="briefcase-outline"></ion-icon>
                           "Cargo" na "Local"
                        </h4>
                        <h4 class="font-h4">
                            <ion-icon name="location-outline"></ion-icon> Local
                        </h4>
                    
                    <div class="bio">
                        <h3 class="font-h3">Sobre mim</h3>
                        <p>minha bio</p>  
                    </div>

                    <div class="interesses">
                        <h3 class="font-h3">Interesses</h3>
                        <p>
                    <?php 
                        $dados_interesses = $u->mostraInteresse($id_user);

                        for ($i=0; $i<count($dados_interesses); $i++) { 
                            foreach ($dados_interesses[$i] as $key => $value){
                                if($key == 'interesse'){
                                    echo $value." ";
                                }
                            }
                        }
                            ?>
                        </p>
                    </div>
                </div>

                <button class="btn-circle"><ion-icon name="create-outline"></ion-icon></button>
            </div>

            <?php 
                $id = $_SESSION['id_usuario']; 
            ?>

        <form method="get" action="index.php" onsubmit="return sweetalertclick(this);">
                <input id="sair" class="bnt" type="submit" value="Sair do perfil">
            </form>

        </main>
    </div>

    <?php 
    
    ?>

   

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Fim Jquery -->

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

    <script src="js/sweetalert2.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>

     <script>
        function sweetalertclick(form){
            Swal.fire({
              title: 'Tem certeza que deseja sair?',
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sair'
            }).then((result) => {
              if (result.isConfirmed) {
               form.submit();
              }
            });
            return false;
        }

    </script>

        <!-- classe active dos botões do menu superior-->
    <script type="text/javascript">
        $(document).on('click', 'ul li', function(){
            $(this).addClass('active').siblings().removeClass('active')
        })
    </script>
    <!-- Fim classe active dos botões do menu superior--> 

</body>
</html>