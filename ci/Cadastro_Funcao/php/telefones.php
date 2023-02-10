<?php 
    include('conexao.php');
    //pega o id via GET
    $id = filter_input(INPUT_GET,'id');
    //pesquisa no banco na coluna 
    $query_telefone ="SELECT telefone_id, telefone FROM usuario 
    JOIN telefone ON usuario.id = telefone.usuario_id 
    WHERE usuario.id LIKE '%$id%'";
    $result_telefone = mysqli_query($conexao, $query_telefone);
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
    <a href="novo_registro.php"><button class="btn btn-dark">Novo Registro</button></a>
    <div class="box">
        <div class="">
        <?php
            while($rows = mysqli_fetch_array($result_telefone)){
                ?> <input class="form-control" type="text" value=" <?php echo $rows['telefone']; ?> " readonly> <?php
                
                $telefone_id = $rows['telefone_id'];
                echo"<a href='funcao_deletar_telefone.php?telefone_id=$telefone_id'><button class='btn btn-danger'>-</button></a>";
                echo"<a href='atualizar_telefone.php?telefone_id=$telefone_id'><button class='btn btn-secondary'>Atualizar dados</button></a>";
                ?> <br> <?php
            }
            echo"<a href='novo_telefone.php?id=$id'><button class='btn btn-secondary'>+</button></a>"
            ?>
            </div>
    </div>
</body>

</html>