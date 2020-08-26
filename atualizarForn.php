<?php

session_start();
require("conexao.php");

if(isset($_SESSION['id']) && empty($_SESSION['id'])==false){


    $idForn = filter_input(INPUT_POST, 'idforn');
    $codInterno = filter_input(INPUT_POST, 'cod-forn');
    $cnpj = filter_input(INPUT_POST, 'cnpj');
    $nomeFornecedor = filter_input(INPUT_POST, 'nome-forn');
    $representante = filter_input(INPUT_POST, 'nome-rep');
    $telefone = filter_input(INPUT_POST, 'telefone');

    $atualizar="UPDATE usuarios SET codInt = '$codInterno', cnpj = '$cnpj', nome = '$nomeFornecedor', representante = '$representante', telefone = '$telefone' WHERE idUser = $idForn ";
    $sql = $db->query($atualizar);
    if($sql){
        echo "<script>alert('Atualizado com Sucesso!');</script>";
        echo "<script>window.location.href='lista-fornecedor.php'</script>";
    }else{
        echo "Erro";
    }

}

?>