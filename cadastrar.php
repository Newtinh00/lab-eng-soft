<?php
    require_once 'classes/usuarios.php';
   $u = new Usuario("app","localhost","root","");
?>

<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Projeto Login</title>
    <link rel="stylesheet" href = "CSS/estilo.css">
</head>
<body>
    <div id="corpo-form-cad">
    <h1>Cadastrar</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
        <input type="text" name="telefone"placeholder="Telefone" maxlength="30">
        <input type="email" name="email"placeholder="E-mail"maxlength="40">
        
        <label for="masc">Masculino</label>
        <label for="fem">Feminino</label>
        <label for="n-bin">Não-Binário</label>
        <input type="radio" id="masc" name="genero" value=1>
        <input type="radio" id="fem" name="genero" value=2>
        <input type="radio" id="n-bin" name="genero" value=3>

        <input type="password" name="senha"placeholder="Senha" maxlength="15">
        <input type="password" name="confsenha" placeholder="Confirmar senha" maxlength="15">

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

        <input type="submit" value="Cadastrar">
        
    </form>
    </div>
   

    <?php
    //verificar se clicou no botao
    if(isset($_POST['nome']))//verifica a existencia do arrey "POST"
    {
        $nome = addslashes($_POST['nome']);
        $telefone= addslashes($_POST['telefone']);
        $email= addslashes($_POST['email']);
        $senha= addslashes($_POST['senha']);
        $confirmarSenha= addslashes($_POST['confsenha']);
        $genero =addslashes($_POST['genero']);
        $interesse = $_POST['interesses'];
        //verificar se esta preenchido
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha) && !empty($genero)) 
        {
            //CONEXAO BANCO DE DADOS
            if($u->msgErro == "")//se esta tudo ok
            {
                if($senha == $confirmarSenha)
                {
                   if( $u->cadastrar($nome,$telefone,$email,$senha,$genero,$interesse))
                   {
                       ?>
                       <div id="msg-sucesso"> cadastrado com sucesso, acesse para entrar</div>

                       <?php
                        header("location: index.php");
                        ?>

                       <?php

                   }
                   else
                   {
                       ?>
                       <div class="msg-erro"> Email ja cadastrado</div>
                       <?php
                   }
                    
                }
                else
                {
                    
                    ?>
                       <div class="msg-erro"> Senha e confirmar senha nao corresponde</div>
                       <?php
                }
                

            }
            else
            {
                ?>
                <div class="msg-erro">
                    <?php echo "Erro: ".$u->msgErro;?>
            </div>
            <?php

            }

        }else
        {
            ?>
                <div class="mensagem erro"> Preencha todos os campos</div>
                       <?php
            
        }
    }


    ?>
</body>
</html>