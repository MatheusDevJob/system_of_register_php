<?php 
    include('conexao.php');
    //pega o id via GET
    $id = filter_input(INPUT_GET,'id');
    //pesquisa no banco na coluna 
    $query_grupo ="SELECT grupo_id, grupo FROM usuario 
    JOIN grupo ON usuario.id = grupo.usuario_id 
    WHERE usuario.id LIKE '%$id%'";
    $result_grupo = mysqli_query($conexao, $query_grupo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style_pesquisa.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>

<body>
    <a href="index.php"><button type="button" class="btn btn-dark">inicio</button></a>
    <a href="banco_dados.php"><button type="button" class="btn btn-dark">Pesquisar no Banco</button></a>
    <a href="novo_registro.php"><button class="btn btn-dark">Novo Registro</button></a>
    <div class="box">
        <div class="">
        <?php
            while($rows = mysqli_fetch_array($result_grupo)){
                ?> <input class="form-control" type="text" value=" <?php echo $rows['grupo']; ?> " readonly> <?php
                
                $grupo_id = $rows['grupo_id'];
                echo"<a href='funcao_deletar_grupo.php?grupo_id=$grupo_id'><button class='btn btn-danger'>-</button></a>";
                echo"<a href='atualizar_grupo.php?grupo_id=$grupo_id'><button class='btn btn-secondary'>Atualizar dados</button></a>";
                ?> <br> <?php
            }
            echo"<a href='novo_grupo.php?id=$id'><button class='btn btn-secondary'>+</button></a>"
            ?>
            </div>
    </div>
</body>

</html>