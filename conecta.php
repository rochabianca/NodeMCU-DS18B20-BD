<?php

$usuario = "root";
$senha = "";
$host = "localhost";

$conexao = mysql_connect($host, $usuario, $senha);
$selecionabd = mysql_select_db('nodemcu', $conexao);

if($conexao) {
    // echo "conectado com sucesso";
} else {
    echo "erro ao conectar";
}

?>