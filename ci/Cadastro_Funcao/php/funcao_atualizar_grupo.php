<?php
include('conexao.php');

$grupo_id = filter_input(INPUT_GET,'grupo_id');
$grupo = filter_input(INPUT_GET,'grupo');
$query_update_grupo = "UPDATE grupo SET grupo = '$grupo' WHERE grupo_id = $grupo_id";
mysqli_query($conexao, $query_update_grupo);
header("Location: banco_dados.php");