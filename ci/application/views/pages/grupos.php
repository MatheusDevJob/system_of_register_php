<style>
    #grupo,
    #grupo_div,
    #grupo_div_botao_confir {
        margin: 1em 0 1em 0;
    }

    #body {
        margin-top: 1em;
    }

    form {
        margin-top: 6%;
    }
</style>
<script>
    $(document).ready(function() {
        pesquisa_grupos_para_tela();
    });

    function pesquisa_grupos_para_tela() {

        // $('#grupo').html('<i class="fa-spinner"></i>'); falta adicionar api para icones
        $.ajax({
            url: '<?= base_url() ?>grupo/lista_grupos',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                var event_data = '';
                $.each(data, function(key, value) {
                    event_data += '<div class="row"><div class= "option_grupo' + value.id + ' col-sm-10">';
                    event_data += '<input value="' + value.descricao + '" type="text" class="form-control input_grupo" style="margin-bottom: 3px;">';
                    event_data += '<input value="' + value.id + '" type="hidden" class="input_grupo_id"></div>';
                    event_data += '<div class="col-sm-1"><button class="btn btn-dark button_delete" onclick="deleta_grupo(' + value.id + ')">Deletar</button></div></div>';
                });
                $('#grupo').html('');
                $('#grupo').append(event_data);
            }
        });
    };

    function deleta_grupo(id) {
        $.ajax({
            url: '<?= base_url() ?>grupo/apagar_grupo',
            type: "POST",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                $(".alert").html('');
                $(".alert").append('<div class="alert alert-primary" role="alert">Deletado com Sucesso!</div>');
            },
            error: function(d) {
                console.log(d);
                $(".alert").html('');
                $(".alert").append('<div class="alert alert-primary" role="alert">Não foi possível deletar. Grupo em uso.</div>');
            }
        });
        $("#grupo").html('');
        pesquisa_grupos_para_tela();
        timeAlert();
    }


    function registra_grupo() {
        let novo_grupo = new Array();
        $(".grupos").each(function() {
            novo_grupo.push($(this).val());
        });
        $('#novo_grupo').val();
        $.ajax({
            url: "<?= base_url() ?>grupo/registra_grupo",
            type: 'POST',
            dataType: "JSON",
            data: {
                novo_grupo: novo_grupo
            },
            success: function(data) {
                $(".alert").html('');
                $(".alert").append('<div class="alert alert-primary" role="alert">Registrado com Sucesso!</div>');

            },
            error: function(d) {
                $(".alert").html('');
                $(".alert").append('<div class="alert alert-primary" role="alert">Falha ao Registrar</div>');
            }
        });
        pesquisa_grupos_para_tela();
        timeAlert();
    }

    function atualiza_grupos() {
        let grupos = new Array();
        let grupos_id = new Array();
        $(".input_grupo_id").each(function() {
            grupos_id.push($(this).val());
        });
        $(".input_grupo").each(function() {
            grupos.push($(this).val());
        });

        $.ajax({
            url: '<?= base_url() ?>grupo/confirma_grupo',
            type: 'POST',
            dataType: 'JSON',
            data: {
                grupos: grupos,
                grupos_id: grupos_id
            },
            success: function(data) {
                $(".alert").html('');
                $(".alert").append('<div class="alert alert-primary" role="alert">Atualizado com Sucesso!</div>');
            },
            error: function(d) {
                $(".alert").html('');
                $(".alert").append('<div class="alert alert-primary" role="alert">Falha ao Atualizar</div>');
            }
        });
        pesquisa_grupos_para_tela();
        timeAlert();
    }

    function timeAlert() {
        setTimeout(function() {
            $(".alert").html('');
        }, 3000);
    }
</script>


<form>
    <div id="body" class="container alert alert-dark">
        <h1><?= $title ?></h1>
        <div class="form-group alert"></div>
        <div class="row">
            <div class="col-sm-6">
                <label>
                    <h2>Editar Grupos</h2>
                </label>
                <div class="area_grupos">
                    <ul id="grupo" class="list-group list-group-flush grupo"></ul>
                </div>
                <div class="col-sm-12" style="text-align: right;">
                    <button class="btn btn-dark" onclick="atualiza_grupos()">Atualizar</button>
                </div>
            </div>
            <div class="col-sm-6">
                <form id="registro" method="POST">
                    <div class="row">
                        <label>
                            <h2>Novo Grupo</h2>
                        </label>
                        <div id="grupo_div" class="col-sm-8">
                            <input id="novo_grupo" name="novo_grupo" placeholder="novo_grupo" type="text" class="form-control grupos" require>
                        </div>
                        <div id="grupo_div_botao_confir" class="col-sm-2">
                            <button type="button" class="btn btn-success" onclick="registra_grupo()">Confirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>