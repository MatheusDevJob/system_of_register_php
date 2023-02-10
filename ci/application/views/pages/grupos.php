<style>
    .area_grupos {
        width: 400px;
    }
    .button_delete{
        margin: 5px;
    }
</style>
<script>
    $(document).ready(function() {
        pesquisa_grupos_para_tela();
    });

    function pesquisa_grupos_para_tela() {

        $.ajax({
            url: '<?= base_url() ?>grupo/lista_grupos',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                var event_data = '';
                $.each(data, function(key, value) {
                    event_data += '<div class= "option_grupo' + value.id + '">';
                    event_data += '<input value="' + value.descricao + '" type="text" class="input_grupo">';
                    event_data += '<input value="' + value.id + '" type="hidden" class="input_grupo_id">';
                    event_data += '<button class="btn btn-dark button_delete" onclick="deleta_grupo(' + value.id + ')">Deleta</button></div>';
                });
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
                $(".alert").append('<div class="alert alert-primary" role="alert">Falha ao Deletar</div>');
            }
        });
        $("#grupo").html('');
        pesquisa_grupos_para_tela();
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
    }
</script>
<h1><?= $title ?></h1>
<div class="form-group alert"></div>
<form id="registro" method="POST" class="collapse">
    <div id="grupo_div" class="form-group">
        <label>Novo Grupo</label>
        <input id="novo_grupo" name="novo_grupo" placeholder="novo_grupo" type="text" class="form-control grupos" require>
    </div>
    <button type="button" class="btn btn-success" onclick="registra_grupo()">Confirmar</button>
</form></br>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#registro" aria-expanded="false">Registro</button>
<div class="area_grupos">
    <ul id="grupo" class="list-group list-group-flush grupo"></ul>
</div>
<button class="btn btn-dark" onclick="atualiza_grupos()">Atualizar</button>