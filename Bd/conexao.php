<?php 

//Arquivo para conectar ao banco de dados

$conn = 1; //PC E COOPAMA
//$conn = 2; //PC PESSOAL

switch ($conn){
    case 1:
    {
        $host = 'localhost';
        $dbName = 'projetoControleEstoqueVenda';
        $user = 'root';
        $senha = 'Be15se90@';

        break;
    }
    case 2:
    {
        $host = 'localhost';
        $dbName = 'oficina';
        $user = 'root';
        $senha = '';

    }
}


$conexao = mysqli_connect($host, $user, $senha, $dbName);

/*if ($conexao) {
	echo 'Conectou';
} else{
	echo 'Não conectou';
} */
