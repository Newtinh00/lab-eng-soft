<?php
require_once 'classes/usuarios.php';
$u = new Usuario("app","localhost","root","");

?>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Projeto Login</title>
    <link rel="stylesheet" href ="CSS/estilo.css">
</head>
<body>
    <div id="corpo-form">
    <h1>Entrar</h1>

    <form method="POST">
        <input type="email"  class="caixa" placeholder="Usuário"name="email">
        <input type="password" class="caixa" placeholder="Senha"name="senha">
        <input type="submit" class="caixa" value="Acessar">
        <a href="cadastrar.php">Ainda não tem cadastro?<strong> Cadastrar-se aqui!</strong></a>
    </form>

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
                    <div class="msg-erro">
                        Email e/ou senha incorretos!
                    <?php

                }

            }
            else 
            {
                ?>
                    <div class="msg-erro">
                        Preencha todos os campos!
                    <?php
            }

        }else
        {
            ?>
                    <div class="msg-erro">
                        <?php echo "Erro: ".$u->msgErro; ?>
                    </div>
                    <?php

        }
    }
    ?>
    </body>

    
</html>