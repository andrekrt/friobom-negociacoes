<?php
session_start();
require("conexao.php");

if(isset($_SESSION['id']) && empty($_SESSION['id']) == false){
    $id = $_SESSION['id'];

    $sql = $db->query("SELECT * FROM usuarios WHERE idUser ='$id'");

    if($sql->rowCount() > 0 ){
        $dado = $sql->fetch();

        $nomeUsuario = $dado['nome'];
        $tipoUsuario = $dado['idTipo'];
        $codFornecedor = $dado['codInt'];
    }
    
}else{
    header("Location:index.php");
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
        
        <div class="container-fluid ">
            <div class="cabecalho">
                <img src="assets/images/logo.png" alt="">
                <div class="titulo">Basto Mesquita Dist e Logistica</div>
            </div>

            <div class="menu">
                <img class="menu-mobile" src="assets/images/menu.png" alt="" onclick="abrirMenu()">
                <nav id="menuMobile">
                    <ul class="nav flex-column">
                        <li class="nav-item"> <a class="nav-link" href="index.php">Início</a></li>
                        <?php
                            
                        if($tipoUsuario==1){
                            echo "<li class='nav-item'> <a class='nav-link' href='adicionar.php'>Nova Negociação</a> </li>";
                            echo "<li class='nav-item'> <a class='nav-link' href='lista-fornecedor.php'>Fornecedores</a> </li>";
                        }
                            
                        ?>
                        <li class="nav-item"> <a class="nav-link" href='sair.php'>Sair</a> </li>
                    </ul>
                </nav>
            </div>
            <div>
                <form action="cadastro-forn.php" method="post">
                    <div class="form-row">
                        <div class="form-grupo espaco col-md-4">
                            <label for="codForn">Código Fornecedor</label>
                            <input type="text" required name="codForn" class="form-control" id="codForn" >
                        </div>
                        <div class="form-grupo espaco col-md-4">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" required name="cnpj" class="form-control" id="cnpj" >
                        </div>
                        <div class="form-grupo espaco col-md-4">
                            <label for="nomeForn">Nome Fornecedor</label>
                            <input type="text" required name="nomeForn" class="form-control" id="nomeForn">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-grupo espaco col-md-4">
                            <label for="nomeRep">Nome Representante</label>
                            <input type="text" required name="nomeRep" class="form-control" id="nomeRep">
                        </div>
                        <div class="form-grupo espaco col-md-4">
                            <label for="telRep">Telefone Representante</label>
                            <input type="text" required name="telRep" class="form-control" id="telRep">
                        </div>
                        <div class="form-grupo espaco col-md-4">
                            <label for="senha">Senha</label>
                            <input type="password" required name="senha" class="form-control" id="senha">
                        </div>
                    </div>            
                    <button type="submit" name="entrada" class="btn btn-success"> Cadastrar</button>
                    <!--<button type="submit" name="saida" class="btn btn-danger"> Lançar Saída </button>-->
                </form>
            </div>
        </div>

        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery.mask.js"></script>
        <script src="assets/js/script.js"></script>
        <script>
            $(document).ready(function(){
                $('#cnpj').mask('00.000.000/0001-00');
                $('#telRep').mask('(00) 00000-0000');
            });
        </script>
    </body>
</html>