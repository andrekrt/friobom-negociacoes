<?php

    session_start();
    require("conexao.php");

    if(isset($_SESSION['id']) && empty($_SESSION['id'])==false){
        $id = $_SESSION['id'];

        $codForn = filter_input(INPUT_POST, "codForn");

        $sql = $db->query("SELECT * FROM movimentacoes WHERE codForn ='$codForn' ");
        if($sql->rowCount()>0){
            echo "Certo";
        }else{
            echo "Erro";
        }
        
    }

?>