<?php
include('conexao.php');


$id = filter_input(INPUT_GET, 'email_id');

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
    <div class="box">
        <form action="funcao_atualizar_email.php">
            <input name="email" type="text" value="">
            <input name="email_id" type="hidden" value=" <?php echo $id; ?>">
            <button type="submit">Confirmar</button>
        </form>
    </div>
</body>

</html>