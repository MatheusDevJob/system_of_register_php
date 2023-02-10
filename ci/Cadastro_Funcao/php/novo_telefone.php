<?php
include('conexao.php');


$telefone = filter_input(INPUT_GET, 'telefone');
$id = filter_input(INPUT_GET, 'id');
$query_pesquisa = "SELECT * FROM usuario 
JOIN telefone ON usuario.id = telefone.usuario_id";

$result_tabela = mysqli_query($conexao, $query_pesquisa);

$insert_telefone = "INSERT INTO telefone (usuario_id, telefone) VALUE ('$id','$telefone')";

if($telefone != ''){        
    mysqli_query($conexao, $insert_telefone);
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
            <form action="novo_telefone.php">
                <input name="telefone" type="text">
                <input name="id" type="hidden" value="<?php echo $id; ?>">
                <button type="submit">Registrar novo Telefone</button>
            </form>
        </div>
    </div>
</body>

</html>

