<?php

session_start();
require("conexao.php");

if(isset($_SESSION['id']) && empty($_SESSION['id'])==false){
    $id = $_SESSION['id'];
    $idMovi = filter_input(INPUT_POST, 'idMovi');
    $_SESSION['idMov']=$idMovi;
    
    $sql = $db->query("SELECT * FROM usuarios WHERE idUser ='$id'");

    if($sql->rowCount() > 0 ){
        $dado = $sql->fetch();

        $nomeUsuario = $dado['nome'];
        $tipoUsuario = $dado['idTipo'];
        $codFornecedor = $dado['codInt'];
    }
    
    if(isset($_POST['editar'])){
       $selecionar = "SELECT * FROM movimentacoes WHERE id=$idMovi";
        $sql=$db->query($selecionar);
        if($sql->rowCount()>0){
            $dados = $sql->fetch();
            
            $codFornecedor = $dados['codForn'];
            
            $motivo = $dados['motivo'];
            $codCliente = $dados['codCli'];
            $nomeCliente = $dados['nomeCli'];
            $produto = $dados['produto'];
            $tipoPagamento = $dados['tipoPag'];
            $valor = str_replace(".",",",$dados['valor']) ;
            $statusPedido = $dados['statusPed'];
            $tipo = $dados['tipo'];
            $_SESSION['arquivo'] = $dados['arquivo'];


        }
    }elseif(isset($_POST['excluir'])){
        $deletando = "DELETE FROM movimentacoes WHERE id=$idMovi";
        $sql = $db->query($deletando);
        echo "<script>alert('Deletado com Sucesso!');</script>";
        echo "<script>window.location.href='index.php'</script>";
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
            <form action="atualizarNegoc.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idMov" value="<?php echo $idMovi; ?>">
                <div class="form-row">
                    <div class="form-grupo col-md-6 espaco">
                        <label for="cod-forn">Código Fornecedor</label>
                        <select name="cod-forn" id="" class="form-control">
                            <?php
                                $sql = $db->query("SELECT codInt, nome FROM usuarios WHERE idTipo =2 ORDER BY codInt ASC");
                                if($sql>0){
                                    $dados=$sql->fetchAll();{
                                        echo "<option value='$codFornecedor'> $codFornecedor </option>";
                                        foreach($dados as $dado){
                                            echo "<option value='$dado[codInt]'>" .$dado['codInt']. " - ". $dado['nome'].  "</option>";
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-grupo col-md-6 espaco">
                        <label for="motivo">Motivo/Investimento/Gasto</label>
                        <select name="motivo" required id="motivo" class="form-control">
                            <option value="<?php echo $motivo; ?>"> <?php echo $motivo; ?> </option>
                            <option value="de acordo">De Acordo</option>
                            <option value="Verba Mensal">Verbal Mensal</option>
                            <option value="Verba Sell Out">Verba Sell Out</option>
                            <option value="Negociação">Negociação</option>
                            <option value="Negociação Pontual (Cliente)">Negociação Pontual (Cliente)</option>
                            <option value="Descontos">Descontos</option>
                            <option value="Troca (Avaria/Def Fábrica)">Troca (Avaria/ Def Frábica)</option>
                            <option value="Troca (Clientes)">Troca (Clientes)</option>
                            <option value="Compra de Materiais">Compra de Materiais</option>
                            <option value="Ação de Mercado">Ação de Mercado</option>
                            <option value="Ação de Equipe">Ação de Equipe</option>
                            <option value="Preços NF'S Incorretos">Preços NF'S Incorretos</option>
                        </select>
                    </div>
                </div>
                    <div class="form-row">
                    <div class="form-grupo col-md-6 espaco">
                        <label for="cod-cliente">Código Cliente/Beneficiado/Custeador</label>
                        <input type="text" value="<?php echo $codCliente; ?>" required name="cod-cliente" class="form-control" id="cod-cliente">
                    </div>
                    <div class="form-grupo col-md-6 espaco">
                        <label for="nome-cliente">Nome do Cliente</label>
                        <input type="text" value="<?php echo $nomeCliente; ?>" required name="nome-cliente" class="form-control" id="nome-cliente">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-grupo col-md-4 espaco">
                        <label for="obs">Produto/Obs</label>
                        <input type="text" value="<?php echo $produto; ?>" required name="obs" class="form-control" id="obs">
                    </div>
                    <div class="form-grupo col-md-4 espaco">
                        <label for="form-pag">Forma de Pagamento</label>
                        <select name="form-pag" required id="form-pag" class="form-control">
                            <option value="<?php echo $tipoPagamento; ?>"> <?php echo $tipoPagamento; ?> </option>
                            <option value="Bonificação">Bonificação</option>
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Desconto em Título">Desconto em Título</option>
                        </select>
                    </div>
                    <div class="form-group espaco col-md-4">
                        <label for="valor"> Valor (Ex.: 99.99) </label>
                        <input required type="text" value="<?php echo $valor; ?>" id="valor" class="form-control" name="valor">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 espaco">
                        <label for="status">Status</label>
                        <select name="status" required id="status" class="form-control">
                            <option value="<?php echo $statusPedido; ?>"> <?php echo $statusPedido; ?> </option>
                            <option value="Reservado p/ Receber"> Reservado para Receber</option>
                            <option value="Recebido">Recebido</option>
                            <option value="Pendente">Pendente</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-md-6 centro-file">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" value="<?php echo $nomeArquivo ?>" name="imagem">
                            <label for="arquivo" class="custom-file-label">Escolher Arquivo</label><br>
                        </div>
                        
                        
                    </div>
                </div>
                            
                <div class="form-group form-check form-check-inline espaco">
                    <input type="radio" id="entrada" value="Entrada" name="tipo">
                    <label for="entrada" class="form-check-label">Entrada</label>
                </div>
                <div class="form-group form-check form-check-inline espaco">
                    <input type="radio" id="saida" value="Saída" name="tipo">
                    <label for="saida" class="form-check-label">Saída</label>
                </div> <br>
                <button type="submit" name="entrada" class="btn btn-success"> Atualizar Negociação</button>
            </form>
        </div>

        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>