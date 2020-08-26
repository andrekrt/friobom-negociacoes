<?php

session_start();
require("conexao.php");

$tipoUsuario = $_SESSION['tipoUser'];
$codForn = $_SESSION['codForn'];

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Planilha</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php
        if($tipoUsuario==1){
            $arquivo = 'movimentacoes.xls';
            $html = '';
            $html .= '<table border="1">';
            $html .= '<tr>';
            $html .= '<td class="text-center" colspan="11">Relatório Negociações</td>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<td class="text-center font-weight-bold">Código Fornecedor</td>';
            $html .= '<td class="text-center font-weight-bold">Nome Fornecedor</td>';
            $html .= '<td class="text-center font-weight-bold">Data </td>';
            $html .= '<td class="text-center font-weight-bold">Motivo</td>';
            $html .= '<td class="text-center font-weight-bold">Código Cliente</td>';
            $html .= '<td class="text-center font-weight-bold">Nome Cliente</td>';
            $html .= '<td class="text-center font-weight-bold">Produto</td>';
            $html .= '<td class="text-center font-weight-bold">Tipo de Pagamento</td>';
            $html .= '<td class="text-center font-weight-bold">Valor</td>';
            $html .= '<td class="text-center font-weight-bold">Status do Pedido</td>';
            $html .= '<td class="text-center font-weight-bold">Tipo</td>';
            $html .= '</tr>';

            $selec =$db->query("SELECT * FROM movimentacoes INNER JOIN usuarios ON usuarios.codInt = movimentacoes.codForn") ;
            $dados = $selec->fetchAll();
            foreach($dados as $dado){
                $html .= '<tr>';
                $html .= '<td>'.$dado["codForn"].'</td>';
                $html .= '<td>'.$dado["nome"].'</td>';
                $html .= '<td>'. date("d/m/Y", strtotime($dado['dataAtual'])) .'</td>';
                $html .= '<td>'.$dado["motivo"].'</td>';
                $html .= '<td>'.$dado["codCli"].'</td>';
                $html .= '<td>'.$dado["nomeCli"].'</td>';
                $html .= '<td>'.$dado["produto"].'</td>';
                $html .= '<td>'.$dado["tipoPag"].'</td>';
                $html .= '<td>'.$dado["valor"].'</td>';
                $html .= '<td>'.$dado["statusPed"].'</td>';
                $html .= '<td>'.$dado["tipo"].'</td>';
            }

            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/x-msexcel");
            header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
            header ("Content-Description: PHP Generated Data");
            echo $html;
            exit();
        }elseif($tipoUsuario==2){
         
            $arquivo = 'movimentacoes.xls';
            $html = '';
            $html .= '<table border="1">';
            $html .= '<tr>';
            $html .= '<td class="text-center" colspan="9">Relatório Negociações</td>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<td class="text-center font-weight-bold">Data Atual</td>';
            $html .= '<td class="text-center font-weight-bold">Motivo</td>';
            $html .= '<td class="text-center font-weight-bold">Código Cliente</td>';
            $html .= '<td class="text-center font-weight-bold">Nome Cliente</td>';
            $html .= '<td class="text-center font-weight-bold">Produto</td>';
            $html .= '<td class="text-center font-weight-bold">Tipo de Pagamento</td>';
            $html .= '<td class="text-center font-weight-bold">Valor</td>';
            $html .= '<td class="text-center font-weight-bold">Status do Pedido</td>';
            $html .= '<td class="text-center font-weight-bold">Tipo</td>';
            $html .= '</tr>';

            $selec =$db->query("SELECT * FROM movimentacoes WHERE codForn = '$codForn'") ;
            $dados = $selec->fetchAll();
            foreach($dados as $dado){
                $html .= '<tr>';
                $html .= '<td>'.date("d/m/Y", strtotime($dado['dataAtual'])).'</td>';
                $html .= '<td>'.$dado["motivo"].'</td>';
                $html .= '<td>'.$dado["codCli"].'</td>';
                $html .= '<td>'.$dado["nomeCli"].'</td>';
                $html .= '<td>'.$dado["produto"].'</td>';
                $html .= '<td>'.$dado["tipoPag"].'</td>';
                $html .= '<td>'.$dado["valor"].'</td>';
                $html .= '<td>'.$dado["statusPed"].'</td>';
                $html .= '<td>'.$dado["tipo"].'</td>';
            }

            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/x-msexcel");
            header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
            header ("Content-Description: PHP Generated Data");
            echo $html;
            exit();
        
        }
            
        ?>
    </body>
</html>