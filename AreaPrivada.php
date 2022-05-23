<?php
session_start();

if(!isset($_SESSION['id_usuario']))
{
    header("location: index.php");
    exit;
}
require_once 'classes/usuarios.php';
$u = new Usuario("app","localhost","root","");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "CSS/home.css">

    <title>Home</title>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</head>

<body>


    <div class="superior">
         <div class="logo"></div>
        <a href="index.php"> <ion-icon name="exit-outline"></ion-icon></a>
    </div>

 <div class="principal">
        <div class="lateral">
            <div class="user">
                <div class="user_details">
                    <img src="">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <div class="user_info">
                        <h3><?php 

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
                        </h3>
                        <h4>Meu Perfil</h4>
                    </div>  
                </div>
            </div>

            <div class="options">
                <ul>
                    <a href=""><li><ion-icon name="heart-outline"></ion-icon><p>Home</p></li></a>

                    <a href=""><li><ion-icon name="person-circle-outline"></ion-icon><p>Meu Perfil</p></li></a>

                    <a href=""><li><ion-icon name="filter-outline"></ion-icon><p>Filtros</p></li></a>

                    <a href=""><li><ion-icon name="settings-outline"></ion-icon><p>Configurações</p></li></a>

                    <a href=""><li><ion-icon name="at-outline"></ion-icon><p>Sobre</p></li></a>
                </ul>
            </div>
    </div>

    <div class="conteudo">

        <div class="perfil">
            <div class="fotos">

            </div>

            <div class="info">
                <h1>
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
                <h2>
                    <?php 
                       $idade = $u->calculaData($id_user);
                                foreach ($idade as $key => $value){
                                    
                                        echo $value;
                                    
                                }
                            
                    ?>
                </h2>
                <h4>"Cargo" na "Local"</h4>
                <h4>Mora em/no "Lugar"</h4>
            </div>

            <div class="bio">
                <h3>Sobre mim</h3>
                minha bio
            </div>

            <div class="interesses">
                <h3>Interesses</h3>
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
    

    </div>

       <a href="">DELETAR CONTA</a>
    </div>

</body>
</html>



