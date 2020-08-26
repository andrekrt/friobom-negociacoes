<?php

session_start();
require("conexao.php");
$erro="";


if(isset($_POST['cnpj']) && empty($_POST['cnpj'])==false){
    $login = filter_input(INPUT_POST, 'cnpj');
    $senha = md5(filter_input(INPUT_POST, 'senha'));

    $sql = $db->query("SELECT * FROM usuarios WHERE cnpj ='$login' AND senha = '$senha' ");

        if($sql->rowCount() > 0 ){
            $dado = $sql->fetch();

            $_SESSION['id'] = $dado['idUser'];
            header("Location:index.php");

        }else{
            $erro = "CNPJ ou senha está incorreta";
        }
   
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Seja Bem-Vindo</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
        <link rel="manifest" href="favicon/site.webmanifest">
        <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        
        <div class="container centralizar-login">
            <img src="assets/images/logo.png" class="img-fluid logo" alt="">
            <form action="" method="post">
                <div class="form-grupo espaco">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" required name="cnpj" class="form-control" id="cnpj">
                </div>
                <div class="form-grupo espaco">
                    <label for="senha">SENHA:</label>
                    <input type="password" required name="senha" class="form-control" id="senha">
                </div>
                <button type="submit" class="btn btn-primary"> Entrar</button> <br><br>
                <p> <?php echo $erro;  ?> </p> </p>
            </form> <br> <br>
            
        </div>

        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery.mask.js"></script>
        <script>
            $(document).ready(function(){
                $('#cnpj').mask('00.000.000/0001-00');
            });
        </script>
    </body>
</html>