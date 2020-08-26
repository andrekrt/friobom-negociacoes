<?php

session_start();
require("conexao.php");

if(isset($_SESSION['id']) && empty($_SESSION['id'])==false){

    $idMovi = filter_input(INPUT_POST, 'idMov');
    $codFornecedor = filter_input(INPUT_POST, 'cod-forn');
    $motivo = filter_input(INPUT_POST, 'motivo');
    $codCliente = filter_input(INPUT_POST, 'cod-cliente');
    $nomeCliente = filter_input(INPUT_POST, 'nome-cliente');
    $produto = filter_input(INPUT_POST, 'obs');
    $tipoPag = filter_input(INPUT_POST, 'form-pag');
    $valor = str_replace(",",".",filter_input(INPUT_POST, 'valor')) ;
    $statusPed = filter_input(INPUT_POST, 'status');
    $tipo = filter_input(INPUT_POST, 'tipo');
    $nomeArquivo = $_FILES['imagem']['name']?$_FILES['imagem']['name']:$_SESSION['arquivo'];
 

    //echo "$idMovi<br>$codFornecedor<br>$nomeFornecedor<br>$motivo<br>$codCliente<br>$nomeCliente<br>$produto<br>$tipoPag<br>$valor<br>$statusPed<br>$tipo";

    $atualizar="UPDATE movimentacoes SET codForn = '$codFornecedor', motivo = '$motivo', codCli = '$codCliente', nomeCli = '$nomeCliente', produto = '$produto', tipoPag = '$tipoPag', valor = '$valor', statusPed = '$statusPed', tipo = '$tipo', arquivo = '$nomeArquivo' WHERE id = $idMovi ";
    $pasta = 'uploads/';
    $mover = move_uploaded_file($_FILES['imagem']['tmp_name'],$pasta.$nomeArquivo);
    $sql = $db->query($atualizar);
    if($sql){
        echo "<script>alert('Atualizado com Sucesso!');</script>";
        echo "<script>window.location.href='index.php'</script>";
    }else{
        echo "Erro";
    }

}

?>