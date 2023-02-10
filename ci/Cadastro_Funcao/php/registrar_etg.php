<?php
include('conexao.php');

$id = filter_input(INPUT_GET, 'id');
$email = filter_input(INPUT_GET, 'email');
$tel = filter_input(INPUT_GET, 'tel');
$grupo = filter_input(INPUT_GET, 'grupo');


$query_email = "INSERT INTO email (usuario_id, email) VALUES ('$id', '$email')";
$query_tel = "INSERT INTO telefone (usuario_id, telefone) VALUES ('$id', '$tel')";
$query_grupo = "INSERT INTO grupo (usuario_id, grupo) VALUES ('$id', '$grupo')";

mysqli_query($conexao, $query_email);
mysqli_query($conexao, $query_tel);
mysqli_query($conexao, $query_grupo);

header('Location: index.php');