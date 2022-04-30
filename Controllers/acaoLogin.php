<?php 

header('Content-Type: application/json;charset=utf-8');

session_start();

require_once "../Bd/conexao.php";

$msg = '';
$tipo = '';
$titulo = '';
$instrucaoSQL = '';

if(!empty($_POST['acao'])){
	
	switch ($_POST['acao']) {


		case 'cadastrar':
		{

			$sqlConsulta = "SELECT * FROM users WHERE nome = '".$_POST['nomeAdd']."' AND email = '".$_POST['emailAdd']."' ";

			$retornoConsulta = $conexao->query($sqlConsulta);

			if (mysqli_num_rows($retornoConsulta) > 0) {
				
				$tipo = 'info';
				$titulo = 'Atenção';
				$msg = 'Usuário já está cadastrado';

			} else {

					if (!empty($_POST['senhaConfirmacao']) && $_POST['senhaConfirmacao'] == 'Coop@2022') {


						$sql = "INSERT INTO users (nome, email, senha, dataCriacao)
						 VALUES('".$_POST['nomeAdd']."', '".$_POST['emailAdd']."', '".md5($_POST['senhaAdd'])."', '".date('Y-m-d H:i:s')."')";


						$retorno = $conexao->query($sql);

						if ($retorno) {
							
							$msg = "Usuário inserido com sucesso!";
							$tipo = "success";
							$titulo = "Sucesso!";

						} else{

							$tipo = 'info';
							$titulo = "Atenção";
							$msg = "Houve um erro ao inserir, por favor volte e confira os dados novamente.";
						}
					}
		}

		break;
	}

	case 'logar':
	{

		$email = $_POST['emailLogin'];
		$senha = md5($_POST['senhaLogin']);

		$sql = "SELECT * FROM users WHERE email = '".$email."' AND senha = '".$senha."'";
		$retornoConsulta = $conexao->query($sql);
		$arrayRetorno = array();


		if ($sqlRetorno = mysqli_fetch_assoc($retornoConsulta)) {
		    $arrayRetorno = array(
		        'nome' => $sqlRetorno['nome'],
                'email' => $sqlRetorno['email'],
                'idLogin' => $sqlRetorno['id'],
                'dataCriacao' => $sqlRetorno['dataCriacao'],
            );
			$tipo = 'success';
			$_SESSION['logado'] = $arrayRetorno;
//			$titulo = 'Sucesso!';
//			$msg = 'Você será redirecionado para a página.';
//			$instrucaoSQL = $retornoConsulta;
//
//			header('Location: ../teste.php')
//
//			foreach ($retornoConsulta as $key) {
//
//			$_SESSION['logado'] = [
//				'nome' => $key['nome'],
//			];
//
//			}
//
		} else {
			$tipo = 'info';
			$titulo = 'Atenção';
			$msg = 'Email ou senha incorreta, por favor tente novamente.';

		}

		break;

	}
        case 'sair':
            {
                session_destroy();
                $tipo = 'success';
            }
			
      

			break;
		
		default:
			// code...
			break;
	}

}

$retorno = [
  'msg' => $msg,
  'tipo' => $tipo,
  'titulo' => $titulo,
  'sql' => $instrucaoSQL,
];

echo json_encode($retorno);
