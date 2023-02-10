<?php
include('conexao.php');

$grupo_id = filter_input(INPUT_GET,'grupo_id');
$query_deletar_grupo = "DELETE FROM grupo WHERE grupo_id = '$grupo_id'";
mysqli_query($conexao, $query_deletar_grupo);
header("Location: banco_dados.php");