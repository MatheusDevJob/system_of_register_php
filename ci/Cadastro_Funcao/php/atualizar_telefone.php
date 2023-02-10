<?php

$id = filter_input(INPUT_GET, 'telefone_id');


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
        <form action="funcao_atualizar_telefone.php">
            <input name="telefone" type="text">
            <input name="telefone_id" type="hidden" value=" <?php echo $id; ?>">
            <button type="submit">Confirmar</button>
        </form>
    </div>
</body>

</html>