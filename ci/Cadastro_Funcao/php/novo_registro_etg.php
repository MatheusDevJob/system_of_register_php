<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <a href="index.php"><button type="button" class="btn btn-dark">inicio</button></a>
    <a href="banco_dados.php"><button type="button" class="btn btn-dark">Pesquisar no Banco</button></a>

    <form action="registrar_etg.php">
        <div class="form-group">
            <label for="exampleInputEmail1">Endereço de email</label>
            <input type="text" class="form-control" placeholder="Your Email exemplo@exemplo.com" name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Telefone</label>
            <input name="tel" placeholder="Seu Telefone" type="tel" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Grupo</label>
            <input name="grupo" placeholder="Seu Grupo" type="text" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</body>

</html>