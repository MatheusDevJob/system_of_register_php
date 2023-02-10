<?php
include('conexao.php');

$telefone_id = filter_input(INPUT_GET,'telefone_id');
$query_deletar_telefone = "DELETE FROM telefone WHERE telefone_id = '$telefone_id'";
mysqli_query($conexao, $query_deletar_telefone);
header("Location: banco_dados.php");