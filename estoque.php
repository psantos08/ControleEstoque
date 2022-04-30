<?php

session_start();
require "padrao.php";
require_once "Bd/conexao.php";

//Consulta itens para tabela
$sqlConsultaTabela = "SELECT p.nomeProduto, p.marcaProd, p.modeloProd, p.estoqueMinimo, ep.qtd AS qtdAtual, ep.valorUnitario 
FROM produtos p
INNER JOIN entradaProdutos ep ON ep.idProduto = p.id
WHERE p.statusProduto = 1
ORDER BY ep.qtd ASC";
$retornoConsultaTabela = $conexao->query($sqlConsultaTabela);

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Estoque</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">

                            <div class="col-12" id="btns">

                                <div class="row">

                                    <!-- BTNS -->
                                    <div class="col-12 col-sm-6 col-lg-6 alinhaItensCenter">
                                        <button class="btn btn-lg btn-primary" id="adicionar">Adicionar</button>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6 alinhaItensCenter">
                                        <button class="btn btn-lg btn-primary" id="consulta">Consultar</button>
                                    </div>

                                </div>
                            </div>

                            <!-- Resultado Adicionar -->
                            <div class="col-12" id="resultAdicionar" style="display: none">

                                <!-- Título da Página -->
                                <div class="col-12 col-sm-12 col-lg-12 divCinza alinhaItensCenter">
                                    <h4>Adicionar Produtos</h4>
                                </div>

                                <!-- Retorno do adicionar -->
                                <form method="post" name="adicionarAddProd" id="formAdd" enctype="multipart/form-data">

                                    <div class="row">
                                        <!-- Codígo do Produto -->
                                        <div class="col-12 col-sm-2 col-lg-2">
                                            <input type="text" name="codProd" class="form-control" id="codProd" placeholder="Codígo do Produto">
                                        </div>

                                        <!-- Descrição do Produto -->
                                        <div class="col-12 col-sm-10 col-lg-10">
                                            <input type="text" name="descProd" class="form-control" id="descProd" placeholder="Descrição do Produto">
                                        </div>

                                        <hr>

                                        <!-- Qauntidade do Produto -->
                                        <div class="col-12 col-sm-2 col-lg-2 inputsForm">
                                            <input type="text" name="qtdProd" class="form-control" id="qtdProd" placeholder="Quantidade do Produto">
                                        </div>


                                        <!-- Quantidade Minima do Produto -->
                                        <div class="col-12 col-sm-2 col-lg-2 inputsForm">
                                            <input type="number" name="qtdMinProd" class="form-control" id="qtdMinProd" placeholder="Quant. Minima do Produto">
                                        </div>

                                        <!-- Preço do Produto -->
                                        <div class="col-12 col-sm-2 col-lg-2 inputsForm">
                                            <input type="number" name="precoUniProd" class="form-control" id="precoUniProd" placeholder="Preço Unitário do Produto">
                                        </div>

                                        <!-- Marca do Produto -->
                                        <div class="col-12 col-sm-3 col-lg-3 inputsForm">
                                            <input type="text" name="marcaProd" class="form-control" id="marcaProd" placeholder="Marca do Produto">
                                        </div>

                                        <!-- Modelo do Produto -->
                                        <div class="col-12 col-sm-3 col-lg-3 inputsForm">
                                            <input type="text" name="modeloProd" class="form-control" id="modeloProd" placeholder="Modelo do Produto">
                                        </div>
                                    </div>

                                </form>

                                <div class="row" style="padding-top: 25px">

                                    <div class="col-12 col-sm-6 col-lg-6 alinhaItensCenter">
                                        <button class="btn btn-success" id="adicionarProd" onclick="cadastraProduto()">Adicionar</button>
                                    </div>

                                    <div class="col-12 col-sm-6 col-lg-6 alinhaItensCenter">
                                        <button class="btn btn-info" id="voltarAddProd">Voltar</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Consulta de Produtos -->
                            <div class="col-12" id="resultConsultarProd" style="display: none">

                                <!-- Título da Página -->
                                <div class="col-12 col-sm-12 col-lg-12 divCinza alinhaItensCenter">
                                    <h4>Consultar Produtos</h4>
                                </div>

                                <!-- Tabela de estoque -->
                                <table class="table table-bordered table-striped" id="tabelaConsultaProd">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nome do Produto</th>
                                            <th scope="col">Marca do Produto</th>
                                            <th scope="col">Modelo do Produto</th>
                                            <th scope="col">Estoque Atual</th>
                                            <th scope="col">Estoque Minimo</th>
                                            <th scope="col">Preço Unitário</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $htmlTable = '';

                                            foreach ($retornoConsultaTabela as $item){
                                                $htmlTable .= '<tr>';
                                                $htmlTable .= '<td>' . $item['nomeProduto'] . '</td>';
                                                $htmlTable .= '<td>' . $item['marcaProd'] . '</td>';
                                                $htmlTable .= '<td>' . $item['modeloProd'] . '</td>';
                                                $htmlTable .= '<td>' . $item['qtdAtual'] . '</td>';
                                                $htmlTable .= '<td>' . $item['estoqueMinimo'] . '</td>';
                                                $htmlTable .= '<td>' . $item['valorUnitario'] . '</td>';
                                                $htmlTable .= '<td>Opa</td>';
                                                $htmlTable .= '</tr>';
                                            }

                                        echo $htmlTable;
                                    ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.js"></script>

<script>

    //Clique em adicionar
    $("#adicionar").click(function (){

        //Mostra form de adicionar
        $("#resultAdicionar").show();
        $("#resultConsultarProd").hide();

        //Oculta os btn
        $("#btns").hide();

    });

    //Clique em voltar do adicionar produto
    $("#voltarAddProd").click(function (){

        //Oculta os forms
        $("#resultAdicionar").hide();
        $("#resultConsultar").hide();

        //Mostra os btn
        $("#btns").show();
    });

    //Cçique em consultar
    $("#consulta").click(function (){

        //Mostra o conteúdo para consultar
        $("#resultConsultarProd").show();
        $("#resultAdicionar").hide();

        //Oculta os btn
        $("#btns").hide();
    });

    function cadastraProduto(){
        var dados = new FormData($("form[name='adicionarAddProd']")[0]);
        dados.append('acao', 'adicionaProduto');

        $.ajax({
            type: 'POST',
            url: 'Controllers/acaoEstoque.php',
            data: dados,
            processData: false,
            contentType: false,
            success: function (response){
                console.log('Foi para a ação');
                if (response['tipo'] == 'success'){
                    Swal.fire({
                        icon: response['tipo'],
                        title: response['titulo'],
                        html: response['msg'],
                        showConfirmButton: false,
                        timer: 5000,
                        toast: false
                    });

                    //Recarrega a página
                    // window.location.reload();
                } else{
                    Swal.fire({
                        icon: response['tipo'],
                        title: response['titulo'],
                        html: response['msg'],
                        toast: false,
                    })
                }
            },
            error: function (response){
                console.log('Não foi para a ação');
            }
        })

    }

</script>

<style>
    .alinhaItensCenter{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0
    }
    .inputsForm{
        padding-top: 20px;
    }
    .divCinza{
        background-color: #f0f0f0;
        padding-bottom: 8px;
        margin-top: 41px;
        padding-top: 20px;
        border-radius: 5px;
        margin-bottom: 18px;
    }
</style>
