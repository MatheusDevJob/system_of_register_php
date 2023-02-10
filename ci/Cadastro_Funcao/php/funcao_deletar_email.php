<?php
include('conexao.php');

$email_id = filter_input(INPUT_GET,'email_id');
$query_deletar_email = "DELETE FROM email WHERE email_id = '$email_id'";
mysqli_query($conexao, $query_deletar_email);
header("Location: banco_dados.php");