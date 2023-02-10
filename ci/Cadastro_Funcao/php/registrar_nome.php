<?php
include('conexao.php');


$nome = filter_input(INPUT_GET, 'nome');


$query_nome = "INSERT INTO usuario (nome) VALUES ('$nome')";
$result_nome = mysqli_query($conexao, $query_nome);


//filtra e retorna o último id da tabela
$query_all_table = "SELECT * FROM usuario ORDER BY id DESC LIMIT 1";
$result_table = mysqli_query($conexao, $query_all_table);
$resultado_table = mysqli_fetch_array($result_table);
$last_id = $resultado_table['id'];

header("Location: novo_registro_etg.php?last_id=$last_id");
    //$resultado_nome = mysqli_fetch_array($query_nome);
    //$resultado_email = mysqli_fetch_array($query_email);
    //$resultado_tel = mysqli_fetch_array($query_tel);
    //$resultado_grupo = mysqli_fetch_array($query_grupo);
    //SELECT * FROM usuario ORDER BY usuario_id DESC