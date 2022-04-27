<?php 

session_start();

$rota = $_SERVER['REQUEST_URI'];

switch($rota){
	case './index.php':
	{
		if (isset($_SESSION['logado'])) {
			require "./index.php";
		} else{
			require "./default.php";
		}

		break;
	}

	default:
	{
		require "./login.php";
	}
}
