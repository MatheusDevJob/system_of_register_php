<?php
    include('conexao.php');
    $id = filter_input(INPUT_GET,'id');
    $query_update_email = "UPDATE email SET email = 'matheushenrique215@hotmail.com.br' WHERE email_id = $id;"
?>