<?php
require_once 'classes/usuarios.php';
$u = new Usuario("app","localhost","root","");

?>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href ="CSS/estilo.css">

        <!-- Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Fim Ionic Icons -->


    <script type="text/javascript">
        function mostrarDiv(){
            document.getElementById("msg-erro").style.opacity="1";
        }
        setTimeout("mostrarDiv()",0);

        function escondeDiv(){
            document.getElementById("msg-erro").style.opacity="0";
            document.getElementById("msg-erro").style.transition="visibility 0s 2s, opacity 2s linear";
        }
        setTimeout("escondeDiv()",4000);

    </script>

</head>
<body>

<div class="conteudo">
    <div class="login">
        <div class="esquerda">
            <form method="POST">
                <h1>Entrar</h1>
                <input type="email"  class="caixa" placeholder="Usuário"name="email">
                <input type="password" class="caixa" placeholder="Senha"name="senha">
                <input type="submit" class="button" value="Acessar">
                <p>Ainda não tem cadastro?</p>
                <a href="cadastrar.php"><strong> Cadastrar-se aqui!</strong></a>
            </form>
        </div>
        <div class="direita">
            <img src="imagem/date.jpg">
        </div>
    </div>
</div>

    <!-- <label for="checkbox" class="toggler">
        <input type="checkbox" id="checkbox">
        <span class="ball"></span>
        <i class="ri-sun-line sun"></i>
        <i class="ri-moon-line moon"></i>
    </label> -->

    <?php
    if(isset($_POST['email']))//verifica a existencia do arrey "POST"
    {
        $email= addslashes($_POST['email']);
        $senha= addslashes($_POST['senha']);

        //verificar se esta preenchido

        if(!empty($email) && !empty($senha) )
        {
            if($u->msgErro =="")
            
            {
                if($u->logar($email,$senha))
                {
                    header("location: AreaPrivada.php");

                }
                else
                {
                    ?>
                    <div id="msg-erro" class="msg-erro">
                        <ion-icon name="alert-circle"></ion-icon>
                        Email e/ou senha incorretos!

                    </div>
                    <?php
                }
            }
            else 
            {
                ?>
                    <div id="msg-erro" class="msg-erro">
                        <ion-icon name="alert-circle"></ion-icon>
                        Preencha todos os campos!
                    </div>
                    <?php
            }

        }else{
                ?>
                    <div id="msg-erro" class="msg-erro">
                       <ion-icon name="alert-circle"></ion-icon>
                        Preencha todos os campos!
                    </div>
                <?php
        }
    }
    ?>

    <?php 
        if(isset($_POST['user_delete'])){

            $user_delete = $_POST['user_delete'];
            $u->deletarUser($user_delete);
            header("location: sair.php");
        }
    ?>


    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Fim Jquery -->


    </body>

    
</html>