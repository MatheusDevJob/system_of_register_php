<nav id="navegacao" class="navbar navbar-expand-lg navbar-light bg-light">
    <ol class="nav nav-tabs">
        <li class="nav-item">
            <a href="<?= base_url() ?>contato/pesquisar" class="<?= $pesquisa ?>"><span>Pesquisar no Banco</span></a>
        </li>
        <li class="nav-item">
            <a href='<?= base_url() ?>contato/registrar_nome' class="<?= $contato ?>">Novo Registro</a>
        </li>
        <li class="nav-item">
            <a href='<?= base_url() ?>grupo/registrar_grupo' class="<?= $grupo ?>">Grupos</a>
        </li>
    </ol>
    <div class="nav navbar-right panel_toolbox">
        <a href="<?= base_url() ?>login/logout"><button class="btn btn-dark">logout</button></a>
    </div>
</nav>
