<?php
include('conexao.php');

$email_id = filter_input(INPUT_GET,'email_id');
$email = filter_input(INPUT_GET,'email');
$query_update_email = "UPDATE email SET email = '$email' WHERE email_id = '$email_id'";
mysqli_query($conexao, $query_update_email);
header("Location: banco_dados.php");