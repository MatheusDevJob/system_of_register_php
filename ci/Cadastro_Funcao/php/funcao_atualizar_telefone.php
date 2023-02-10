<?php
include('conexao.php');

$telefone_id = filter_input(INPUT_GET,'telefone_id');
$telefone = filter_input(INPUT_GET,'telefone');
$query_update_telefone = "UPDATE telefone SET telefone = '$telefone' WHERE telefone_id = $telefone_id";
mysqli_query($conexao, $query_update_telefone);
header("Location: banco_dados.php");