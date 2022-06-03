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



    <script type="text/javascript">
        $('.carousel').carousel();
    </script>

</head>
<body>

<?php
    $id = $_SESSION['id_usuario']; 
    $res = $u->buscarDadosEdicao($id);
?>
    <div class="superior">
        <ul>
            <li><a id="btn_option" href="javascript::" onclick="load_page('meu_perfil.php')"><ion-icon name="person"></ion-icon></a>
            </li>

            <li><a id="btn_option" href="javascript::" onclick="load_page()"><ion-icon name="chatbubble"></ion-icon></a></li>

            <li class="active"><a id="btn_option" href="home.php""><ion-icon class="active" name="home"></ion-icon></a></li>

            <li><a id="btn_option" href=""><ion-icon name="filter"></ion-icon><</a></li>

            <li><a id="btn_option" href="javascript::" onclick="load_page('settings.php')"><ion-icon name="settings"></ion-icon></a></li>
        </ul>
    </div>

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

                    <form method="POST">
<!--
-->

                        <label for="local">Escolaridade
                            <br>  
                            <input name="local" type="text"  id="local" value="<?php if(isset($res)){echo $res['escolaridade'];}?>">
                        </label>

                        <label for="academica">
                            Mora em:
                            <br>  
                            <input name="escolaridade" type="text"  id="escolaridade" value="<?php if(isset($res)){echo $res['local'];}?>">
                        </label>


                        <label for="cargo">Cargo
                            <br>  
                            <input type="text" name="cargo" id="cargo" value="<?php if(isset($res)){echo $res['cargo'];}?>">
                        </label>

                        <label for="empresa">Empresa
                            <br>  
                            <input type="text" name="empresa" id="empresa" value="<?php if(isset($res)){echo $res['local_trabalho'];}?>">
                        </label>

<!--                       <label for="local">Local
                            <br>
                            <select>
                                <option value="ac">Acre</option>
                                <option value="al">Alagoas</option>
                                <option value="ap">Amapá</option>
                                <option value="am">Amazonas</option>
                                <option value="ba">Bahia</option>
                                <option value="ce">Ceará</option>
                                <option value="es">Espírito Santo</option>
                                <option value="go">Goiás</option>
                                <option value="ma">Maranhão</option>
                                <option value="mt">Mato Grosso</option>
                                <option value="ms">Mato Grosso do Sul</option>
                                <option value="mg">Minas Gerais</option>
                                <option value="pa">Pará</option>
                                <option value="pb">Paraíba</option>
                                <option value="pr">Paraná</option>
                                <option value="pe">Pernambuco</option>
                                <option value="pi">Piauí</option>
                                <option value="rj">Rio de Janeiro</option>
                                <option value="rn">Rio Grande do Norte</option>
                                <option value="rs">Rio Grande do Sul</option>
                                <option value="ro">Rondônia</option>
                                <option value="rr">Roraima</option>
                                <option value="sc">Santa Catarina</option>
                                <option value="sp">São Paulo</option>
                                <option value="se">Sergipe</option>
                                <option value="to">Tocantins</option>
                                <option value="df">Distrito Federal</option>
                            </select>
                        </label>
-->     
                        <label for="bio">Sobre Mim
                            <br>
                            <textarea maxlength="500" id="bio" name="bio"><?php if(isset($res)){echo $res['bio'];}?>
                            </textarea>
                        </label>

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
                        <input type="submit" class="editar" name="editar" value="Salvar">
                    </form>

                </div>
            </div>
        </main>
    </div>

    <?php 

    if(isset($_POST['editar']) && isset($_POST['empresa'])) {

        $local_trabalho = addslashes($_POST['empresa']);
        $mora = addslashes($_POST['local']);
        $academica = addslashes($_POST['escolaridade']);
        $cargo = addslashes($_POST['cargo']);
        $bio = $_POST['bio'];

        $id = $_SESSION['id_usuario']; 

        //if(empty($local_trabalho) || empty($cargo) || empty($bio) ){

            $u->editarUsuario($id, $local_trabalho, $bio, $cargo, $mora, $academica);
            ?>
                <div id="msg-sucesso" class="sucesso"> 
                    <ion-icon name="checkmark-circle"></ion-icon>
                        Alterado com sucesso!
                </div>
            <?php
        //}

    }

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