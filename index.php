<?php

session_start();
require("conexao.php");

if(isset($_SESSION['id']) && empty($_SESSION['id']) == false){
    $id=$_SESSION['id'];
    $totalEntrada=0;
    $totalSaida=0;
    $saldo=0;
    
    if(isset($_POST['codForn'])){
        $codBusc = $_POST['codForn'];
    }else{
        $codBusc="";
    }
    if(isset($_POST['dataInicial'])){
        $dataInicio = $_POST['dataInicial'];
    }
    if(isset($_POST['dataFinal'])){
        $dataFim = $_POST['dataFinal'];
    }
    $sql = $db->query("SELECT * FROM usuarios WHERE idUser = '$id'" );
    

    if($sql->rowCount()>0){
        $dado=$sql->fetch();

        $nomeFornecedor = $dado['nome'];
        $tipoUsuario = $dado['idTipo'];
        $codInterno = $dado['codInt'];

        $_SESSION['tipoUser'] = $tipoUsuario;
        $_SESSION['codForn'] = $codInterno;

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
        <title>Página Inicial</title>
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

            <!-- menu mobile paraa desktop -->

            <div class="menu">
                <img class="menu-mobile" src="assets/images/menu.png" alt="" onclick="abrirMenu()">
                <nav id="menuMobile">
                    <ul class="nav flex-column">
                        <li class="nav-item"> <a class="nav-link" href="adicionar.php">Nova Negociação</a></li>
                        <?php
                            
                        if($tipoUsuario==1){
                            echo "<li class='nav-item'> <a class='nav-link' href='form-fornecedor.php'>Novo Fornecedor</a> </li>";
                            echo "<li class='nav-item'> <a class='nav-link' href='lista-fornecedor.php'>Fornecedores</a> </li>";
                        }
                            
                        ?>
                        <li class="nav-item"> <a class="nav-link" href='sair.php'>Sair</a> </li>
                    </ul>
                </nav>
            </div>

            <!--<div class="area-servicos">
                <div class="nome-usuario">Usuario: <?php //echo $nomeFornecedor ?></div>
                <div class="todos-servicos">
                    <div class="servicos"> <a href="adicionar.php" class="btn btn-primary">Adicionar Nova Negociação</a> </div>
                    <?php
                    
                       /* if($tipoUsuario==1){
                            echo '<div class="servicos"> <a href="form-fornecedor.php" class="btn btn-primary">Cadastrar Novo Fornecedor</a> </div>';
                            echo '<div class="servicos"> <a href="lista-fornecedor.php" class="btn btn-primary"> Fornecedores</a> </div>';
                        }*/
                    
                    ?>
                    <div class="servicos"> <a href="sair.php" class="btn btn-primary">Sair</a> </div>
                </div>
            </div>-->
            <!--  Campos para realizar filtragem  -->
            <div class="filtros">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-vert">
                            <div class="col">
                                <input type="text" class="form-control" name="codForn" placeholder="Código Fornecedor" value="<?php echo $codBusc; ?>"> 
                            </div>
                            <div class="col">
                                <input class="form-control" value="<?php echo $dataInicio; ?>" type="date" name="dataInicial">
                            </div>
                            <div class="col">
                                <input class="form-control" type="date" value="<?php echo $dataFim; ?>" name="dataFinal">
                            </div>
                            <div class="col">
                                <input type="submit" name="filtro" class="btn btn-secondary" value="Pesquisar">
                            </div>
                        </div>
                    </div>
                </form>
                <a href="gerar-planilha.php" name="tipoUser" class="btn btn-success">Gerar Planilha</a>
            </div>
            <!-- finalizando campos de filtragem -->

            <div class="table-responsive">                
                
                    <table class="table table-bordered" id="minhaTabela">
                        <thead class="thead-dark ">
                            
                            
                        </thead>
                        <tbody>
                            
                            <?php

                                if($tipoUsuario==1){
                                    echo "<thead class='thead-dark'>";
                                        echo '<tr>';
                                        echo '  <th  class="text-center align-middle">ID</th>';
                                        echo'   <th scope="col" class="text-center align-middle">Código Fornecedor</th>';
                                        echo'   <th scope="col" class="text-center align-middle">Nome Fornecedor</th>';
                                        echo'   <th scope="col" class="text-center align-middle">Data</th>';
                                        echo '  <th scope="col" class="text-center align-middle"> Motivo </>';    
                                        echo '  <th scope="col" class="text-center align-middle"> Código Cliente </th>';
                                        echo '  <th scope="col" class="text-center align-middle"> Nome Cliente </th>';
                                        echo '  <th scope="col" class="text-center align-middle"> Produto/Observação </th>';
                                        echo '  <th scope="col" class="text-center align-middle">Pagamento</th>';
                                        echo '  <th scope="col" class="text-center align-middle">Valor</th>';
                                        echo '  <th scope="col" class="text-center align-middle">Tipo</th>';
                                        echo '  <th scope="col" class="text-center align-middle"> Arquivo </th>';
                                        echo '  <th scope="col" class="text-center align-middle"> Ações</th>';
                                        echo '</tr>';
                                    echo "</thead>";

                                    if(isset($_POST['filtro']) && ( empty($_POST['codForn'])==false || empty($_POST['dataInicial'])==false || empty($_POST['dataFinal'])==false)) {
                                        //iniciando filtragem de dados
                                        $codForn = filter_input(INPUT_POST, "codForn");
                                        //$nomeForn = filter_input(INPUT_POST, "nomeForn");
                                        $dataInicial = filter_input(INPUT_POST, "dataInicial");
                                        $dataFinal = filter_input(INPUT_POST, "dataFinal");
                                        //$tipo = filter_input(INPUT_POST, "tipo");
                                        $sql = $db->query(" SELECT * FROM movimentacoes INNER JOIN usuarios ON usuarios.codInt = movimentacoes.codForn WHERE codForn ='$codForn' or dataAtual BETWEEN '$dataInicial' AND '$dataFinal' ");
                                       
                                        if($sql->rowCount()>0){
                                            $dados = $sql->fetchAll();

                                            foreach($dados as $dado){
                                                echo "<form action='editar.php' method='post'>";
                                                echo '<tr>';
                                                echo "<td class='text-center align-middle'> <input name='idMovi' class='form-control ocultar' type='text' readonly='true' value='$dado[id]'> </td>";
                                                echo '<td class="text-center align-middle">' . $dado['codForn'] . '</td>';
                                                echo '<td class="text-center align-middle">' . $dado['nome'] . '</td>';
                                                echo '<td class="text-center align-middle">' . date("d/m/Y", strtotime($dado['dataAtual']))  . '</td>';
                                                echo '<td class="text-center align-middle">' . $dado['motivo'] . '</>';
                                                echo '<td class="text-center align-middle">' . $dado['codCli'] . '</td>';
                                                echo '<td class="text-center align-middle">' . $dado['nomeCli'] . '</td>';
                                                echo '<td class="text-center align-middle">' . $dado['produto'] . '</td>';
                                                echo '<td class="text-center align-middle">' . $dado['tipoPag'] . '</td>';
                                                echo '<td class="text-center align-middle"> R$ ' . str_replace(".",",",$dado['valor'])  . '</td>';
                                                echo '<td class="text-center align-middle">' .$dado['tipo'] . '</td>';
                                                $nomeArquivo = $dado['arquivo'];
                                                    $novoNome = "";
                                                    if($nomeArquivo==""){
                                                        $novoNome = "Sem Anexo";
                                                        $link = "";
                                                    }else{
                                                        $novoNome = "<img class='icon-arquivo' src='assets/images/icone-arquivo.png'>";
                                                        $link = "uploads/$nomeArquivo";
                                                    }
                                                    
                                                    echo "<td class='text-center align-middle'> <a href='$link' target='_blank'> $novoNome </a> </td>";
                                                    echo "<td class='text-center align-middle'> <input type='submit' value='Editar' class='btn btn-primary' name='editar'> <input type='submit' value='Excluir' class='btn btn-danger' name='excluir'></td>";
                                                echo '</tr>';
                                                echo "</form>";
                                                if($dado['tipo'] == "Entrada"){
                                                    $totalEntrada = $totalEntrada + $dado['valor'];
                                                }elseif($dado['tipo'] == "Saída"){
                                                    $totalSaida = $totalSaida + $dado['valor'];
                                                }

                                            }
                                            $saldo = $totalEntrada - $totalSaida;
                                            echo "<div class='valores'>";
                                                echo "<p>TOTAL DE ENTRADA: R$ ". str_replace(".",",", $totalEntrada) ."</p>"; 
                                                echo "<p>TOTAL DE SAÍDA: R$ ". str_replace(".",",",$totalSaida) . "</p>" ;
                                                echo "<p>SALDO ATUAL: R$ " . str_replace(".",",", $saldo)."</p>";
                                            echo "</div>";

                                        }
                                        
                                    }else{
                                        //criando limite de registro por páginas
                                        $pagina = (isset($_GET['pagina'])?$_GET['pagina']:1);
                                        $sql = $db->query("SELECT * FROM movimentacoes INNER JOIN usuarios ON usuarios.codInt = movimentacoes.codForn");
                                        

                                        if($sql->rowCount()>0){
                                            $dados = $sql->fetchAll();

                                            
                                            
                                                foreach($dados as $dado){
                                                    echo "<form action='editar.php' method='post'>";
                                                    echo "<tr>";
                                                    echo "<td class='text-center align-middle'> <input name='idMovi' class='form-control ocultar' readonly='true' type='text' value='$dado[id]'> </td>";
                                                    echo '<td class="text-center align-middle">' . $dado['codForn'] . '</td>';
                                                    echo '<td class="text-center align-middle">' . $dado['nome'] . '</td>';
                                                    echo '<td class="text-center align-middle">' . date("d/m/Y", strtotime($dado['dataAtual']))  . '</td>';
                                                    echo '<td class="text-center align-middle">' . $dado['motivo'] . '</>';
                                                    echo '<td class="text-center align-middle">' . $dado['codCli'] . '</td>';
                                                    echo '<td class="text-center align-middle">' . $dado['nomeCli'] . '</td>';
                                                    echo '<td class="text-center align-middle">' . $dado['produto'] . '</td>';
                                                    echo '<td class="text-center align-middle">' . $dado['tipoPag'] . '</td>';
                                                    echo '<td class="text-center align-middle"> R$ ' .  str_replace(".",",",$dado['valor']) . '</td>';
                                                    echo '<td class="text-center align-middle">' .$dado['tipo'] . '</td>';
                                                    $nomeArquivo = $dado['arquivo'];
                                                    $novoNome = "";
                                                    if($nomeArquivo==""){
                                                        $novoNome = "Sem Anexo";
                                                        $link = "";
                                                    }else{
                                                        $novoNome = "<img class='icon-arquivo' src='assets/images/icone-arquivo.png'>";
                                                        $link = "uploads/$nomeArquivo";
                                                    }
                                                    
                                                    echo "<td class='text-center align-middle'> <a href='$link' target='_blank'> $novoNome </a> </td>";
                                                    echo "<td class='text-center align-middle'> <input type='submit' value='Editar' class='btn btn-primary' name='editar'> <input type='submit' value='Excluir' class='btn btn-danger' name='excluir'></td>";
                                                    echo '</tr>';
                                                    echo "</form>";
                                                    if($dado['tipo'] == "Entrada"){
                                                        $totalEntrada = $totalEntrada + $dado['valor'];
                                                    }elseif($dado['tipo'] == "Saída"){
                                                        $totalSaida = $totalSaida + $dado['valor'];
                                                    }

                                                }
                                            
                                            $saldo = $totalEntrada - $totalSaida;
                                            echo "<div class='valores'>";
                                                echo "<p>TOTAL DE ENTRADA: R$ ".str_replace(".",",",$totalEntrada) ."</p>"; 
                                                echo "<p>TOTAL DE SAÍDA: R$ " . str_replace(".",",",$totalSaida) . "</p>" ;
                                                echo "<p>SALDO ATUAL: R$ " . str_replace(".",",",$saldo)."</p>";
                                            echo "</div>";
                                            
                                        }
                                    }

                                    
                                }elseif($tipoUsuario==2){
                                    //tela do usuario fornecedor
                                    echo "<thead class='thead-dark'>";
                                    echo '<tr>';
                                    echo'   <th scope="col" class="text-center">Data</th>';
                                    echo '  <th scope="col" class="text-center"> Motivo </>';    
                                    echo '  <th scope="col" class="text-center"> Código Cliente </th>';
                                    echo '  <th scope="col" class="text-center"> Nome Cliente </th>';
                                    echo '  <th scope="col" class="text-center"> Produto/Observação </th>';
                                    echo '  <th scope="col" class="text-center">Pagamento</th>';
                                    echo '  <th scope="col" class="text-center">Valor</th>';
                                    echo '  <th scope="col" class="text-center">Tipo</th>';
                                    echo '<th scope="col" class="text-center">Arquivo</th>';
                                    echo '</tr>';
                                    echo "</thead>";
                                    

                                    $sql = $db->query("SELECT * FROM movimentacoes WHERE codForn = '$codInterno' ");
                                    if($sql->rowCount()>0){
                                        $dados = $sql->fetchAll();

                                        foreach($dados as $dado){
                                            echo '<tr>';
                                            echo '<td class="text-center">' . date("d/m/Y", strtotime($dado['dataAtual'])) . '</td>';
                                            echo '<td class="text-center">' . $dado['motivo'] . '</>';
                                            echo '<td class="text-center">' . $dado['codCli'] . '</td>';
                                            echo '<td class="text-center">' . $dado['nomeCli'] . '</td>';
                                            echo '<td class="text-center">' . $dado['produto'] . '</td>';
                                            echo '<td class="text-center">' . $dado['tipoPag'] . '</td>';
                                            echo '<td class="text-center"> R$ ' .  $dado['valor'] . '</td>';
                                            echo '<td class="text-center">' .$dado['tipo'] . '</td>';
                                            $nomeArquivo = $dado['arquivo'];
                                            $novoNome = "";
                                            if($nomeArquivo==""){
                                                $novoNome = "Sem Anexo";
                                                $link = "";
                                            }else{
                                                $novoNome = "<img class='icon-arquivo' src='assets/images/icone-arquivo.png'>";
                                                $link = "uploads/$nomeArquivo";
                                            }
                                            
                                            echo "<td class='text-center align-middle'> <a href='$link' target='_blank'> $novoNome </a> </td>";
                                            echo '</tr>';
                                            if($dado['tipo'] == "Entrada"){
                                                $totalEntrada = $totalEntrada + $dado['valor'];
                                            }elseif($dado['tipo'] == "Saída"){
                                                $totalSaida = $totalSaida + $dado['valor'];
                                            }
                                        }
                                        $saldo = $totalEntrada - $totalSaida;
                                        echo "<div class='valores'>";
                                            echo "<p>TOTAL DE ENTRADA: R$ ".$totalEntrada ."</p>"; 
                                            echo "<p>TOTAL DE SAÍDA: R$ " . $totalSaida. "</p>" ;
                                            echo "<p>SALDO ATUAL: R$ " . $saldo."</p>";
                                        echo "</div>";
                                    }

                                }

                            ?>
                        </tbody>
                    </table>
            </div>               
        </div>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script> 
        <script src="assets/js/gerar.js"></script> 
        <script src="assets/js/script.js"></script>  
    </body>
</html>

