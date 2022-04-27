<?php 
session_start();

print_r($_SESSION);

//require "padrao.php";

if (isset($_SESSION)) {
	echo 'Tem sessão sim: ' . print_r($_SESSION['logado']);
} else{
	echo 'Não tem sessão';
}

/*echo (file_exists(session_save_path().'/sess_'.$SESSION_ID) ? "Existe!" : "Não existe!");*/