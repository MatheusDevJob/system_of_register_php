<?php
include('conexao.php');


$grupo = filter_input(INPUT_GET, 'grupo');
$id = filter_input(INPUT_GET, 'id');
$query_pesquisa = "SELECT * FROM usuario 
JOIN grupo ON usuario.id = grupo.usuario_id";

$result_tabela = mysqli_query($conexao, $query_pesquisa);

$insert_grupo = "INSERT INTO grupo (usuario_id, grupo) VALUE ('$id','$grupo')";
if($grupo != ''){        
    mysqli_query($conexao, $insert_grupo);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style_pesquisa.css">
</head>

<body>
    <a href="index.php"><button>Início</button></a>
    <a href="novo_registro.php"><button>Novo Registro</button></a>
    <a href="banco_dados.php"><button>Pesquisar no Banco</button></a>
    <div class="box">
        <div class="">
            <form action="novo_grupo.php">
                <input name="grupo" type="text">
                <input name="id" type="hidden" value="<?php echo $id; ?>">
                <button type="submit">Registrar novo Grupo</button>
            </form>
        </div>
    </div>
</body>

</html>

