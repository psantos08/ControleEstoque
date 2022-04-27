<?php

session_start();
require "padrao.php";

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
    <!-- Conteúdo -->
    <section class="content">
<!--        <div class="container">-->
            <div class="row">
                <div class="col-12">
                <!-- Card Principal -->
                <div class="card">
                    <div class="card-body">
                        <div class="row" id="rowCards">
                            <!-- Cards Secundários -->
                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="card" style="width: 30rem;">
                                    <div class="card-body">
                                        <h5 class="card-title tituloCard">Adicionar</h5>
                                        <p class="card-text">Adicione itens ao seu estoue.</p>
                                        <a href="#" class="btn btn-primary">Adicionar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="card" style="width: 30rem;">
                                    <div class="card-body">
                                        <h5 class="card-title tituloCard">Consultar</h5>
                                        <p class="card-text">Consulte itens do seu estoue.</p>
                                        <a href="#" class="btn btn-primary">Consultar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form cadastrar produtos -->
                <form name="formCadastra" method="post">
                    <div class="row">

                        <!-- Cod Produto -->
<!--                        <div class="col-12 col-sm-2 col-lg-2">-->
<!--                            <div class="input-group mb-3">-->
<!--                                <span class="input-group-text">Cod Produto</span>-->
<!--                                <input type="text" class="form-control camposInput" placeholder="Código" name="codigoProd" aria-label="Codigo" aria-describedby="basic-addon1">-->
<!--                            </div>-->
<!--                        </div>-->

                        <!-- Desc Produto -->
                        <div class="col-12 col-sm-8 col-lg-8">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Descrição Produto</span>
                                <input type="text" class="form-control camposInput" placeholder="Código" name="descProd" aria-label="descProd" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <!-- QTD Produto -->
                        <div class="col-12 col-sm-2 col-lg-2">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Quantidade Produto</span>
                                <input type="text" class="form-control camposInput" placeholder="Quantidade" name="qtdProd" aria-label="qtdProd" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <!-- Preço Produto -->
                        <div class="col-12 col-sm-2 col-lg-2">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Preço Produto</span>
                                <input type="text" class="form-control camposInput" placeholder="Quantidade" name="precoProd" aria-label="precoProd" aria-describedby="basic-addon1">
                            </div>
                        </div>

                    </div>
                </form>
                </div>
            </div>
<!--        </div>-->
    </section>
</div>

<script>
    function mostrarCadastroProduto(){}
</script>

<style>
    .tituloCard{
        font-size: 20px;
        color: #039be5;
    }
</style>
