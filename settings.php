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


            <?php 
                $id = $_SESSION['id_usuario']; 
            ?>

    <div class="conteudo">
        <main>
            <div class="config">
                <form class="" method="POST" action="index.php">

                    <button type="submit" id="deletar" class="bnt" value="<?php echo $id;?>" name="user_delete">Deletar Conta</button>

                </form>
            </div> 
        </main>  
    </div>

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
        function deletarConta(form){
            Swal.fire({
              title: 'Tem certeza que deseja deletar sua conta?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Deletar'
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