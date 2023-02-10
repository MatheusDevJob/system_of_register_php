<style>
    .body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 500px;
    }

    form {
        width: 300px;
        margin-top: 30px;
    }
</style>
<div class="body">
    <div>
        <div class="retorno"><?php $retorno = $this->session->userdata('retorno'); echo $retorno?></div>
        <form method="POST" action="<?= base_url() ?>login/login">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="usuarioHelp" placeholder="Enter usuario">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
                <label for="senha">Password</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Password">
            </div>
            <div class="form-group form-check">
                <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label> -->
            </div>
            <button type="submit" class="btn btn-primary" onclick="loga()">Logar</button>
        </form>
    </div>
</div>