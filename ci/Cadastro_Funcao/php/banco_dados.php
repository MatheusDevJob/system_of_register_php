<?php
include('conexao.php');

//retorna do bd o nome, emails, telefones, e grupos do contato
$nome = filter_input(INPUT_GET, 'nome');
$query_pesquisa = "SELECT DISTINCT id, nome, email, telefone, grupo FROM usuario 
JOIN email ON usuario.id = email.usuario_id 
JOIN telefone ON usuario.id = telefone.usuario_id
JOIN grupo ON usuario.id = grupo.usuario_id WHERE usuario.nome LIKE '%$nome%' GROUP BY id";


$result_tabela = mysqli_query($conexao, $query_pesquisa);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style_pesquisa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <a href="index.php"><button type="button" class="btn btn-dark">inicio</button></a>
    <a href="banco_dados.php"><button type="button" class="btn btn-dark">Pesquisar no Banco</button></a>
    
</body>

</html>