<?php
    require_once 'classes/usuarios.php';
   $u = new Usuario("app","localhost","root","");
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Projeto Login</title>
        <link rel="stylesheet" href ="CSS/estilo.css">
    </head>
    <body>
        <div id="corpo-form-cad">
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" class="caixa" name="nome" placeholder="Nome Completo" maxlength="30">
            <input type="text" class="caixa" name="telefone"placeholder="Telefone" maxlength="30">
            <input type="email" class="caixa" name="email"placeholder="E-mail"maxlength="40">
            
            <div class="radio-button">
                <label for="masc">
                    <input type="radio" id="masc" name="genero" value=1>
                    Masculino
                </label>
                
                <label for="fem">
                    <input type="radio" id="fem" name="genero" value=2>
                    Feminino
                </label>

                
                <label for="n-bin">
                <input type="radio" id="n-bin" name="genero" value=3>    
                    Não-Binário
                </label>
            </div>  
            

            <input type="password" class="caixa" name="senha"placeholder="Senha" maxlength="15">
            <input type="password" class="caixa" name="confsenha" placeholder="Confirmar senha" maxlength="15">

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
                                <input type="checkbox" class="interesse" name="interesses[]" value="<?php echo $value;?>">
                            <?php
                                }
                            ?>
                        </label>
            <?php
                    }   
                }  
            ?>

            <input type="submit" class="caixa" name="save" value="Cadastrar">
            
        </form>
        </div>
    

        <?php

        
        //verificar se clicou no botao
        if(isset($_POST['nome']) && isset($_POST['save']))//verifica a existencia do arrey "POST"
        {
            $nome = addslashes($_POST['nome']);
            $telefone= addslashes($_POST['telefone']);
            $email= addslashes($_POST['email']);
            $senha= addslashes($_POST['senha']);
            $confirmarSenha= addslashes($_POST['confsenha']);
            $genero =addslashes($_POST['genero']);

            $interesses =  $_POST['interesses'];

            //verificar se esta preenchido
            if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha) && !empty($genero)) 
            {
                //CONEXAO BANCO DE DADOS
                if($u->msgErro == "")//se esta tudo ok
                {
                    if($senha == $confirmarSenha)
                    {
                    if( $u->cadastrar($nome,$telefone,$email,$senha,$genero))
                    {
                        ?>
                        <div id="msg-sucesso"> Cadastrado com sucesso, acesse para entrar!</div>

                        <?php 
                            $ultimo_user = $u->ultimoInsert();
                            
                            foreach ($interesses as $item) {

                                $u->insereInteresse($item, $ultimo_user);
                            }
  
                        ?>

                        <?php
                            //header("location: index.php");
                            ?>

                        <?php

                    }
                    else
                    {
                        ?>
                        <div class="msg-erro"> E-mail já cadastrado</div>
                        <?php
                    }
                        
                    }
                    else
                    {
                        
                        ?>
                        <div class="msg-erro"> Senhas não correspondem</div>
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
                    <div class="mensagem erro"> Preencha todos os campos!</div>
                        <?php
                
            }
        }
        ?>
    </body>
</html>