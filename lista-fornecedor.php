<?php

session_start();
require("conexao.php");

if(isset($_SESSION['id']) && empty($_SESSION['id']) == false){
    $id=$_SESSION['id'];

    $sql = $db->query("SELECT * FROM usuarios WHERE idUser = '$id'" );

    if($sql->rowCount()>0){
        $dado=$sql->fetch();

        $nomeFornecedor = $dado['nome'];
        $tipoUsuario = $dado['idTipo'];
        $codInterno = $dado['codInt'];
    }
    
}else{
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Fornecedores</title>
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
        <div class="container-fluid">
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
                            echo "<li class='nav-item'> <a class='nav-link' href='form-fornecedor.php'>Novo Fornecedor</a> </li>";
                        }
                            
                        ?>
                        <li class="nav-item"> <a class="nav-link" href='sair.php'>Sair</a> </li>
                    </ul>
                </nav>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark ">
                        <tr>
                            
                            <th class='text-center'> Código Interno</th>
                            <th class="text-center"> Nome Fornecedor</th>
                            <th class="text-center"> CNPJ</th>
                            <th class="text-center"> Representante</th>
                            <th class="text-center"> Telefone</th>
                            <th scope="col" class="text-center align-middle"> Ações</th>
                        </tr>    
                    </thead>
                    <tbody>
                        <?php
                        
                            $sql = $db->query("SELECT * FROM usuarios WHERE idTipo = 2 ");
                            if($sql->rowCount()>0){
                                $dados = $sql->fetchAll();

                                foreach($dados as $dado){
                                    echo "<form action='editar-forn.php' method='post'>";
                                    echo "<tr>";
                                    echo "  <td class='text-center align-middle'><input name='codInt' class='form-control ocultar' type='text' readonly='true' value='$dado[codInt]'></td>";
                                    echo "  <td class='text-center align-middle'>". $dado['nome'] ."</td>";
                                    echo "  <td class='text-center align-middle'>". $dado['cnpj'] ."</td>";
                                    echo "  <td class='text-center align-middle'>". $dado['representante'] ."</td>";
                                    echo "  <td class='text-center align-middle'>". $dado['telefone'] ."</td>";
                                    echo "<td class='text-center align-middle'> <input type='submit' class='btn btn-primary' value='Editar' name='editar'> <input type='submit' value='Excluir' class='btn btn-danger' name='excluir'></td>";
                                    echo "</tr>";
                                    echo "</form>";
                                }
                            }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery.mask.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>