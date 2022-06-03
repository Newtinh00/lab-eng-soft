<?php
    require_once 'classes/usuarios.php';
   $u = new Usuario("app","localhost","root","");
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar</title>
       <link rel="stylesheet" href ="CSS/estilo.css">
           <!-- Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Fim Ionic Icons -->

    <script type="text/javascript">
        function mostrar(){
            document.getElementById("msg-erro").style.opacity="1";
        }
        setTimeout("mostrar()",0);

        function esconde(){
            document.getElementById("msg-erro").style.opacity="0";
            document.getElementById("msg-erro").style.transition="visibility 0s 2s, opacity 2s linear";
        }
        setTimeout("esconde()",4000);
    </script>


    <script type="text/javascript">
        function mostrarDiv(){
            document.getElementById("msg-sucesso").style.opacity="1";
        }
        setTimeout("mostrarDiv()",0);

        function escondeDiv(){
            document.getElementById("msg-sucesso").style.opacity="0";
            document.getElementById("msg-sucesso").style.transition="visibility 0s 2s, opacity 2s linear";
        }
        setTimeout("escondeDiv()",4000);
    </script>

    </head>
    <body>

        <div id="conteudo" class="conteudo">
                    <div class="caixa-cadastro">
             <h1>Cadastro</h1>
            <div class="cadastro">
                <form method="POST" enctype="multipart/form-data">
        
                    <input type="text" class="caixa" id="nome" name="nome" placeholder="Nome" maxlength="30">
                    <span id="mensagem_erro" class="text-danger"></span>

                    <input type="text" class="caixa" id="telefone" name="telefone"placeholder="Telefone" maxlength="30">

                    <input type="date" class="caixa" name="dt_nascimento">
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
                    <fieldset>
                        <legend>Fotos</legend>
                    <input type="file" name="image[]" multiple>
                    </fieldset>   

                    <input type="password" class="caixa" name="senha"placeholder="Senha" maxlength="15">
                    <input type="password" class="caixa" name="confsenha" placeholder="Confirmar senha" maxlength="15">
                    <hr>

               <div class="checkbox-interesse">
                <p>Interesses</p>
             
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


                </div>
                    <input type="submit" id="submit" class="button" name="save" value="Cadastrar">
                    
                </form>
            </div>
        </div>

        </div>

        <?php

        
        //verificar se clicou no botao
        if(isset($_POST['nome']) && isset($_POST['save'])){ //verifica a existencia do arrey "POST"
        
            $nome = addslashes($_POST['nome']);
            $telefone= addslashes($_POST['telefone']);
            $email= addslashes($_POST['email']);
            $senha= addslashes($_POST['senha']);
            $confirmarSenha= addslashes($_POST['confsenha']);
            
            $genero = addslashes($_POST['genero']);
           
            $dt_nascimento = addslashes($_POST['dt_nascimento']);

            $interesses =  $_POST['interesses'];

            $date = date('Y-m-d');
            $idade = date_diff(date_create($dt_nascimento), date_create($date));

            //verificar se esta preenchido
            if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha) && !empty($genero) && !empty($dt_nascimento)){
             
                if($u->msgErro == ""){ //se esta tudo ok 

                    if($senha == $confirmarSenha){

                        if($idade->format('%y') > 18){

                            if($dt_nascimento < $date || !$dt_nascimento = date('Y-m-d', strtotime($dt_nascimento))){

                                if( $u->cadastrar($nome,$telefone,$email,$senha,$genero,$dt_nascimento)){
                                    ?>

                                    <div id="msg-sucesso" class="msg-sucesso"> 
                                        <ion-icon name="checkmark-circle"></ion-icon>
                                    Cadastrado com sucesso, acesse para entrar!
                                    </div>

                                    <?php 
                                        $ultimo_user = $u->ultimoInsert();
                                        
                                        foreach ($interesses as $item) {

                                            $u->insereInteresse($item, $ultimo_user);
                                        }

                                        $contadorImagem = count($_FILES['image']['name']);

                                        for ($i=0; $i < $contadorImagem ; $i++) { 

                                            $imageName = $_FILES['image']['name'][$i];
                                            $imageTempName = $_FILES['image']['tmp_name'][$i];
                                            $targetPath ="./imagem/". $imageName;

                                            if(move_uploaded_file($imageTempName, $targetPath)){
                                                $u->insereFoto($imageName, $ultimo_user);
                                                }
                                        }

                                }else{
                                    ?>
                                    <div id="msg-erro" class="msg-erro">
                                        <ion-icon name="alert-circle"></ion-icon> 
                                        E-mail já cadastrado!
                                    </div>
                                    <?php
                                }

                            }else{

                                ?>
                                <div id="msg-erro" class="msg-erro">
                                    <ion-icon name="alert-circle"></ion-icon> 
                                    Data inválida!
                                </div>

                                <?php

                            }
                        }else{

                             ?>
                                <div id="msg-erro" class="msg-erro">
                                    <ion-icon name="alert-circle"></ion-icon> 
                                    É necessário ter mais de 18 anos para se cadastrar!
                                </div>
                            <?php

                        }
                    }else{
                        
                        ?>
                        <div id="msg-erro" class="msg-erro">
                            <ion-icon name="alert-circle"></ion-icon> 
                            Senhas não correspondem!
                        </div>

                        <?php
                    }

                }else{

                    ?>
                    <div id="msg-erro" class="msg-erro">
                       <ion-icon name="alert-circle"></ion-icon>
                        <?php echo "Erro: ".$u->msgErro;?>
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

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Fim Jquery -->
    </body>
</html>