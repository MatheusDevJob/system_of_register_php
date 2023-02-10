<?php 
    include('conexao.php');
    $id = filter_input(INPUT_GET,'id');
    $query_email ="SELECT email_id, email FROM usuario 
    JOIN email ON usuario.id = email.usuario_id 
    WHERE usuario.id LIKE '%$id%'";
    $result_email = mysqli_query($conexao, $query_email);


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
            while($rows = mysqli_fetch_array($result_email)){
                ?> <input class="form-control" type="text" value=" <?php echo $rows['email']; ?> " readonly> <?php
                $email_id = $rows['email_id'];
                echo"<a href='funcao_deletar_email.php?email_id=$email_id'><button class='btn btn-danger'>-</button></a>";
                echo"<a href='atualizar_email.php?email_id=$email_id'><button class='btn btn-secondary'>Atualizar dados</button></a>";
                ?> <br> <?php
            }
            echo"<a href='novo_email.php?id=$id'><button class='btn btn-secondary'>+</button></a>"
            ?>
            </div>
    </div>
</body>

</html>