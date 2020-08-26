<?php

session_start();
require("conexao.php");

if(isset($_SESSION['id']) && empty($_SESSION['id'])==false){
    $codInt = filter_input(INPUT_POST, 'codInt');
    $_SESSION['codInt']=$codInt;
    $id = $_SESSION['id'];

    $sql = $db->query("SELECT * FROM usuarios WHERE idUser ='$id'");

    if($sql->rowCount() > 0 ){
        $dado = $sql->fetch();

        $nomeUsuario = $dado['nome'];
        $tipoUsuario = $dado['idTipo'];
        $codFornecedor = $dado['codInt'];
    }
    
    if(isset($_POST['editar'])){
       $selecionar = "SELECT * FROM usuarios WHERE codInt=$codInt";
        $sql=$db->query($selecionar);
        if($sql->rowCount()>0){
            $dados = $sql->fetch();
            
            $idForn = $dados['idUser'];
            $codInterno = $dados['codInt'];
            $nomeForn = $dados['nome'];
            $cnpj = $dados['cnpj'];
            $representante =  $dados['representante'];
            $telefone = $dados['telefone'];
            $senha = $dados['senha'];

            

        }
    }elseif(isset($_POST['excluir'])){
        $deletando = "DELETE FROM usuarios WHERE codInt=$codInt";
        $sql = $db->query($deletando);
        echo "<script>alert('Deletado com Sucesso!');</script>";
        echo "<script>window.location.href='lista-fornecedor.php'</script>";
    }
}else{
    echo "errado";
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
        
        <div class="container-fluid centralizar">
            <div class="cabecalho">
                <img src="assets/images/logo.png" alt="">
                <div class="titulo">Basto Mesquita Dist e Logistica</div>
            </div>

            <div class="area-servicos">
                <div class="nome-usuario">Usuario: <?php echo $nomeUsuario ?></div>
                <div class="todos-servicos">
                    <div class="servicos"> <a href="index.php" class="btn btn-primary">Início</a> </div>
                    <div class="servicos"> <a href="adicionar.php" class="btn btn-primary">Adicionar Nova Negociação</a> </div>
                    <?php
                    
                        if($tipoUsuario==1){
                            echo '<div class="servicos"> <a href="form-fornecedor.php" class="btn btn-primary">Cadastrar Novo Fornecedor</a> </div>';
                            echo '<div class="servicos"> <a href="lista-fornecedor.php" class="btn btn-primary"> Fornecedores</a> </div>';
                        }
                    
                    ?>
                    <div class="servicos"> <a href="sair.php" class="btn btn-primary">Sair</a> </div>
                </div>
            </div>
            <form action="atualizarForn.php" method="post" enctype="multipart/form-data">
                <div class="form-grupo espaco">
                    
                    <input type="hidden" class="form-control" name="idforn" value="<?php echo $idForn; ?>">
                <div/>
                <div class="form-grupo espaco">
                    <label for="cod-forn">Código Fornecedor</label>
                    <input type="text" class="form-control" name="cod-forn" value="<?php echo $codInterno; ?>">
                <div/>
    
                <div class="form-grupo espaco">
                    <label for="motivo">CNPJ
                    <input type="text" class="form-control" name="cnpj" value="<?php echo $cnpj ?>">
                </div>
                <div class="form-grupo espaco">
                    <label for="cod-cliente">Nome</label>
                    <input type="text" value="<?php echo $nomeForn; ?>" required name="nome-forn" class="form-control" id="cod-cliente">
                </div>
                <div class="form-grupo espaco">
                    <label for="nome-cliente">Representante</label>
                    <input type="text" value="<?php echo $representante; ?>" required name="nome-rep" class="form-control" id="nome-cliente">
                </div>
                <div class="form-grupo espaco">
                    <label for="obs">Telefone</label>
                    <input type="text" value="<?php echo $telefone; ?>" required name="telefone" class="form-control" id="obs">
                </div>            
                <button type="submit" name="entrada" class="btn btn-success"> Atualizar Fornecedor</button>
            </form>
        </div>

        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

