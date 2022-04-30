<?php

header('Content-Type: application/json;charset=utf-8');

session_start();

require_once "../Bd/conexao.php";

$post = '';
$tipo = '';
$titulo = '';
$msg = '';

if (!empty($_POST['acao'])){

    switch ($_POST['acao']){

        case 'adicionaProduto':
        {
            //echo 'Chegou aqui';
            //print_r($_POST);
            $codProduto = $_POST['codProd'];
            $descProduto = $_POST['descProd'];
            $qtdProduto = $_POST['qtdProd'];
            $qtdMinProduto = $_POST['qtdMinProd'];
            //$qtdMaxProduto = $_POST['qtdMaxProd'];
            $precoUniProduto = $_POST['precoUniProd'];
            $marcaProduto = $_POST['marcaProd'];
            $modeloProduto = $_POST['modeloProd'];

            $sqlInsertProd = "INSERT INTO produtos(codProduto, nomeProduto, marcaProd, modeloProd, estoqueMinimo, statusProduto, dataCriacao, idLoginCriacao) 
                    VALUES(
                            $codProduto,
                            '".$descProduto."',
                            '".$marcaProduto."',
                            '".$modeloProduto."',
                            $qtdMinProduto,
                            1,
                            '".date('Y-m-d H:i:s')."',
                            ".$_SESSION['logado']['idLogin']."      
                          )";
//            print_r($sqlInsertProd);
//            exit();

            $insereProduto = $conexao->query($sqlInsertProd);
            if ($insereProduto){
               $idInserido = mysqli_insert_id($conexao);

               //Se inseriu e gerou o id do produto realizo o insert na entrada de produtos
                if ($idInserido){
                    $sqlInsertEstoque = "INSERT INTO entradaProdutos(idProduto, qtd, valorUnitario, idLoginCriacao, dataCriacao)
                                         VALUES(
                                                 $idInserido,
                                                 $qtdProduto,
                                                 $precoUniProduto,
                                                 ".$_SESSION['logado']['idLogin'].",
                                                 '".date('Y-m-d H:i:s')."'
                                         )";
                    $insereEntradaProduto = $conexao->query($sqlInsertEstoque);

                    //Confere se a instrução toda está correta e da o retorno
                    if ($insereEntradaProduto){
                        $tipo = 'success';
                        $titulo = 'Sucesso!';
                        $msg = 'Produto inserido com sucesso ao seu estoque.';
                    } else{
                        $tipo = 'info';
                        $titulo = 'Atenção!';
                        $msg = 'Houve um erro ao inserir o produto, por favor volte e confira novamente.';
                    }
                }

            } else{
                echo 'Não inseriru';

            }
            break;
        }
    }
}

$retorno = [
    'msg' => $msg,
    'tipo' => $tipo,
    'titulo' => $titulo,
    'post' => $post
];

echo json_encode($retorno);
