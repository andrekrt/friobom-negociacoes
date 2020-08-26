<?php

session_start();
require("conexao.php");

if(isset($_SESSION['id']) && empty($_SESSION['id'])==false){
    $dataAtual = date("y/m/d");
    $codForn = filter_input(INPUT_POST, 'cod-forn');
    $motivo = filter_input(INPUT_POST, 'motivo');
    $codCli = filter_input(INPUT_POST,'cod-cliente');
    $nomeCli = filter_input(INPUT_POST, 'nome-cliente');
    $produto = filter_input(INPUT_POST, 'obs');
    $formPag = filter_input(INPUT_POST, 'form-pag');
    $valor = str_replace(",",".",filter_input(INPUT_POST, 'valor')) ;
    $status = filter_input(INPUT_POST, 'status');
    $tipo = filter_input(INPUT_POST, 'tipo');
    $nomeArquivo = $_FILES['imagem']['name'];
    $idUsuario= $_SESSION['id'];

    if(isset($_POST['entrada'])){
        $inserindo = "INSERT INTO movimentacoes (codForn, dataAtual, motivo, codCli, nomeCli, produto, tipoPag, valor, statusPed, tipo, arquivo, idUsuario) VALUES ('$codForn', '$dataAtual', '$motivo', '$codCli', '$nomeCli', '$produto', '$formPag', '$valor', '$status', '$tipo','$nomeArquivo', $idUsuario)";
        $sql = $db->query($inserindo);
        $pasta = 'uploads/';
        $mover = move_uploaded_file($_FILES['imagem']['tmp_name'],$pasta.$nomeArquivo); 
        if($sql){
            header("Location:index.php");
        }else{
            echo "erro";
        }
    
    }elseif(isset($_POST['saida'])){
        echo "Está lançando uma saída";
    }else{
        echo "nenhum";
    }

}else{
    header("Location:adicionar.php");
}

?>