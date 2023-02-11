<nav id="navegacao" class="navbar navbar-expand-lg navbar-light bg-light justify-content-md-center">
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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" style="margin-left: 50em;">
        Perfil
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nome Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav>
                        <ul class="list-group">
                            <li class="list-group-item"><a class="perfil_link" href="#">Perfil</a></li>
                            <li class="list-group-item"><a class="perfil_link" href="#">Permissões</a></li>
                            <li class="list-group-item"><a class="perfil_link" href="#">Configurações</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="modal-footer">
                    <div class="nav navbar-right panel_toolbox">
                        <a href="<?= base_url() ?>login/logout"><button class="btn btn-dark">logout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Modal -->
</nav>