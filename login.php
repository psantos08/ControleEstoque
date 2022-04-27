<?php

require 'Bd/conexao.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OnDisk | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>OnDisk - </b>Login</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg" id="msgInfo">Entre com seu login e senha</p>

      <form action="" method="post" id="logar">
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="emailLoga" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span> 
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="senhaLoga" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" id="btnLogar" class="btn btn-success btn-block" onclick="logar()">Logar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <!-- Form de cadatrar um novo usuário -->
      <form method="post" id="cadastrar" style="display: none;">

        <!-- Nome do cadastrado -->
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nomeAdd" id="nomeAdd" placeholder="Nome">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span> 
            </div>
          </div>
        </div>


        <!-- Email do cadastrado -->
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="emailAdd" id="emailAdd" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span> 
            </div>
          </div>
        </div>


        <!-- Senha do cadastrado -->
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="senhaAdd" id="senhaAdd" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>


        <!-- Senha para cadastrar -->
        <div class="input-group mb-3">
          <input type="password" name="senhaCadastro" class="form-control" id="senhaConfirmAdd" placeholder="Senha para confirmar cadastro">
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button class="btn btn-primary btn-block" id="btnAdd" name="enviar" value="cadastrar" onclick="adicionarUsuario(this)">Cadastrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->
      <p class="mb-0">
        <a href="#" id="novoUser" class="text-center">Cadastrar novo usuário</a>
        <a href="#" id="login" class="text-center" style="display: none;">Logar</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.js"></script>

<!-- Scripts da página -->
<script>

  $("#btnAdd").click(function(e){
    e.preventDefault();
  });

  $("#btnLogar").click(function(e){
    e.preventDefault();
  });
  
  //Clicou em adicionar outro usuário oculta o form de logar e mostra o de cadastrar o novo user
  $("#novoUser").click(function(){
      $("#logar").css('display', 'none');
      $("#msgInfo").html('Cadastre um novo usuário');
      $("#cadastrar").show();
      $("#novoUser").hide();
      $("#login").show();
  });

  //Clicou em logar oculta o form de novo user e apresenta o de logar
  $("#login").click(function (){
      $("#cadastrar").css('display', 'none');
      $("#msgInfo").html('Insira suas credenciais');
      $("#novoUser").show();
      $("#logar").show();
      $("#login").hide();

  });

  //Realiza o login
  function logar(e){
    var email = document.getElementById("emailLoga").value;
    var senha = document.getElementById("senhaLoga").value;
    var dados = new FormData();
    dados.append("emailLogin", email);
    dados.append("senhaLogin", senha);
    dados.append("acao", "logar");

    $.ajax({
      type: 'POST',
      url: 'Controllers/acaoLogin.php',
      processData: false,
      contentType: false,
      data: dados,
      success: function(response){
        
        if (response['tipo'] == 'success') {
          
          window.location.href = './index.php';
        
        } else{

            Swal.fire({
              icon: response['tipo'],
              title: response['titulo'],
              html: response['msg'],
              toast: false,
            });
        }
      },

      error: function(response){
        console.log("Não foi para a ação");
      },
    });
  }


  //Adicionar um novo usuário
  function adicionarUsuario(e){
    //e.preventDefault();
      console.log('Entrou aqui');
    var nome = document.getElementById("nomeAdd").value;
    var email = document.getElementById("emailAdd").value;
    var senha = document.getElementById("senhaAdd").value;
    var senhaConfirmacao = document.getElementById("senhaConfirmAdd").value;
    var acao = document.getElementById("btnAdd").value;
    var dados = new FormData();
    dados.append("nomeAdd", nome);
    dados.append("emailAdd", email);
    dados.append("senhaAdd", senha);
    dados.append("senhaConfirmacao", senhaConfirmacao);
    dados.append("acao", acao);
    $.ajax({
      type: 'POST',
      url: 'Controllers/acaoLogin.php',
      processData: false,
      contentType: false,
      data: dados,
      success: function(response){
        
        if (response['tipo'] == 'success') {
          Swal.fire({
            icon: response['tipo'],
            title: response['titulo'],
            html: response['msg'],
            toast: false,
          });
        } else{
          Swal.fire({
            icon: response['tipo'],
            title: response['titulo'],
            html: response['msg'],
            toast: false,
          });
        }

      },
      error: function(response){
        console.log("Não foi para ação");
      }
    })

  }

</script>

</body>
</html>
