<?php

    session_start();
    require("conexao.php");

    if(isset($_SESSION['id']) && empty($_SESSION['id'])==false){
        $codForn = filter_input(INPUT_POST, 'codForn');
        $cnpj = filter_input(INPUT_POST, 'cnpj');
        $nomeForn = filter_input(INPUT_POST, 'nomeForn');
        $nomeRep = filter_input(INPUT_POST, 'nomeRep');
        $telRep = filter_input(INPUT_POST, 'telRep');
        $senha = md5(filter_input(INPUT_POST, 'senha'));

        $consulta = $db->query("SELECT * FROM usuarios WHERE codInt = '$codForn' ");
        if($consulta->rowCount()>0){
            echo "<script>alert('Este Fornecedor já está cadastrado');</script>";
            echo "<script>window.location.href='form-fornecedor.php'</script>";
        }else{
            $sql = $db->query("INSERT INTO usuarios (codInt, cnpj, nome, representante, telefone, senha, idTipo) VALUES ('$codForn', '$cnpj', '$nomeForn', '$nomeRep', '$telRep', '$senha', 2) ");

            if($sql){
                echo "<script>alert('Fornecedor Cadastrado com Sucesso!');</script>";
                echo "<script>window.location.href='index.php'</script>";

            }else{
                echo "Erro";
            }   
        }


    }

?>