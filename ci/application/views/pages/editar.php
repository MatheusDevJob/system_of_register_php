<style>
    .novos_registros {
        padding: 20px;
        width: 45%;

    }

    .registros {
        margin-left: 20px;
        width: 100%;
        display: flex;
    }

    main {
        display: flex;
        justify-content: space-between;
    }

    .dados_extra {
        width: 100%;
    }

    .header_registro {
        display: flex;
        justify-content: space-between;
    }

    .bottom_registro {
        display: flex;
        justify-content: center;
    }
</style>
<script>
    // funcao retorna todos os dados do usuario a ser editado
    $(document).ready(function() {
        pesquisa();
    });

    function pesquisa() {
        var id = <?= $id ?>;
        var event_data = '';
        var botao = '';
        $.ajax({
            url: '<?= base_url() ?>contato/pesquisa_id',
            type: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {

                $("#contato_div").append('<input id="contato" name="contato" value="' + data.nome[0].nome + '" type="text" class="form-control">');

                $.each(data.email, function(key, value) {
                    event_data = '<input id="email" type="text" class="form-control email_" value="' + value.email + '" name="email[]">'
                    event_data += '<input id="email_id" name="email[]" value="' + value.id + '" type="hidden" class="form-control emails_id">'
                    event_data += '<button onclick="deleta_email(this.value)" class="btn btn-sm btn-danger" value="' + value.id + '" type="button">Delete</button><br>'
                    $("#email_div").append(event_data);
                });
                
                $.each(data.telefone, function(key, value) {
                    event_data = '<input id="telefone" name="tel[]" value="' + value.telefone + '" type="tel" class="form-control telefone_">'
                    event_data += '<input id="telefone_id" name="telefone[]" value="' + value.id + '" type="hidden" class="form-control telefones_id">'
                    event_data += '<button onclick="deleta_telefone(this.value)" class="btn btn-sm btn-danger" value="' + value.id + '" type="button">Delete</button><br>'
                    $("#telefone_div").append(event_data);
                });
                $.each(data.grupo, function(key, value) {
                    event_data = '<div id="grupo_div_' + value.grupo_id + '">';
                    event_data += '<input id="grupo_id" name="grupo[]" value="' + value.id + '" type="hidden" class="form-control grupos_id">'
                    event_data += '<button onclick="deleta_grupo(this.value)" class="btn btn-sm btn-danger" value="' + value.id + '" type="button">Delete</button><br>'
                    event_data += '</div>';
                    $("#grupo_div").append(event_data);
                    todos_grupos(value.grupo_id);
                });
            },
        });
    }


    // função retorna todas as opções de grupos disponíveis
    function todos_grupos(contato_grupoID) {
        var event_data = '';
        $.ajax({
            url: '<?= base_url() ?>grupo/lista_grupos',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                var event_data = '';
                event_data += '<select id="grupo" name="grupo" class="form-group form-control-sm grupo_">';
                $.each(data, function(key, value) {
                    if (contato_grupoID == value.id) {
                        event_data += '<option value="' + value.id + '"selected>' + value.descricao + '</option>';
                    } else {
                        event_data += '<option value="' + value.id + '">' + value.descricao + '</option>';
                    }
                });
                event_data += '</select>';
                $('#grupo_div_' + contato_grupoID).prepend(event_data);
            }
        });
    }

    function deleta_telefone(id) {
        $.ajax({
            url: "<?= base_url() ?>contato/apagar_telefone/",
            type: "POST",
            dataType: 'JSON',
            data: {
                id: id
            }
        });
        // $(".area_input").html("");
        // pesquisa();
    }

    function deleta_email(id) {
        $.ajax({
            url: "<?= base_url() ?>contato/apagar_email/",
            type: "POST",
            dataType: 'JSON',
            data: {
                id: id
            }
        });
    }

    function deleta_grupo(id) {
        $.ajax({
            url: "<?= base_url() ?>grupo/apagar_grupo/",
            type: "POST",
            dataType: 'JSON',
            data: {
                id: id
            }
        });
    }

    function atualiza() {
        let emails = new Array();
        let emails_id = new Array();
        let telefones = new Array();
        let telefones_id = new Array();
        let grupos = new Array();
        let grupos_id = new Array();
        var nome = $('#contato').val();
        var nome_id = <?= $id ?>;
        $(".email_").each(function() {
            emails.push($(this).val());
        });
        $(".telefone_").each(function() {
            telefones.push($(this).val());
        });
        $(".grupo_").each(function() {
            grupos.push($(this).val());
        });
        $(".emails_id").each(function() {
            emails_id.push($(this).val());
        });
        $(".telefones_id").each(function() {
            telefones_id.push($(this).val());
        });
        $(".grupos_id").each(function() {
            grupos_id.push($(this).val());
        });

        console.log(nome, nome_id, emails, emails_id, telefones, telefones_id, grupos, grupos_id);
        $.ajax({
            url: '<?= base_url() ?>Contato/confirmar',
            type: 'POST',
            dataType: 'json',
            data: {
                nome_id: nome_id,
                nome: nome,
                email: emails,
                email_id: emails_id,
                telefone: telefones,
                telefone_id: telefones_id,
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
        atualiza_grupo(grupos, grupos_id);
    }

    function atualiza_grupo(grupos, grupos_id) {
        $.ajax({
            url: '<?= base_url() ?>grupo/confirmar_grupo_contato',
            type: 'POST',
            dataType: 'json',
            data: {
                grupos: grupos,
                grupos_id: grupos_id
            }
        });
    }

    function novos_registros() {
        let email = new Array();
        let telefone = new Array();
        var id = <?= $id ?>;
        $('.emails_').each(function() {
            email.push($(this).val());
        });
        $('.telefones_').each(function() {
            telefone.push($(this).val());
        });
        console.log(email, telefone, id);
        $.ajax({
            url: '<?= base_url() ?>contato/novos_registros',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id,
                email: email,
                telefone: telefone
            },
            success: function(data) {
                $(".alert").html('');
                $(".alert").append('<div class="alert alert-primary" role="alert">Registrado com Sucesso!</div>');
            },
            error: function(data) {
                $(".alert").html('');
                $(".alert").append('<div class="alert alert-primary" role="alert">Falha ao Registrar</div>');
            }
        });
    }

    function novo_email() {
        $("#novo_email_div").append('<label for="exampleInputEmail1">Endereço de email</label><input id="email" type="text" class="form-control emails_" placeholder="Novo E-mail" name="email[]">');
    };

    function novo_telefone() {
        $("#novo_telefone_div").append('<label for="exampleInputPassword1">Telefone</label> <input id="telefone" name="telefone" placeholder="Novo Telefone" type="tel" class="form-control telefones_">');
    };
</script>
<h1><?= $title ?></h1>
<button type="button" class="btn btn-primary" data-toggle='collapse' data-target='#area_novos_dados'>Adicionar Dados</button>
<!-- AREA DE REGISTRO DE NOVOS DADOS -->
<div class="form-group alert"></div>
<main>
    <div class="registros">
        <form id="registro" method="POST">
            <div class="area_input">
                <div class="form-group header_registro">
                    <div id="contato_div" class="form-group">
                        <label>Nome do Contato</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Grupo</label></br>
                        <div id="grupo_div"></div>
                    </div>
                </div>
                <div class="form-group bottom_registro">
                    <div id="email_div" class="form-group">
                        <label for="exampleInputEmail1">Endereço de email</label>
                    </div>
                    <div id="telefone_div" class="form-group">
                        <label for="exampleInputPassword1">Telefone</label>
                    </div>
                </div>
                </br>
                <button type="button" form="registro" onclick="atualiza()" class="btn btn-success">Confirmar</button>
            </div>
            <div id="botao_area"></div>
        </form>
    </div>
    <div class="dados_extra">
        <div id='area_novos_dados' class="novos_registros collapse">
            <form id="novos_dados">
                <div id="novo_email_div" class="form-group">
                    <label for="exampleInputEmail1">Endereço de email</label>
                    <input id="email" type="text" class="form-control emails_" placeholder="exemplo@exemplo.com" name="email[]">
                </div>
                <!-- BOTAO NOVO EMAIL -->
                <button onclick="novo_email()" type="button" id="add_campo_email" class="btn btn-secondary">+</button>
                <div id="novo_telefone_div" class="form-group">
                    <label for="exampleInputPassword1">Telefone</label>
                    <input id="telefone" name="tel[]" placeholder="Seu Telefone" type="tel" class="form-control telefones_">
                </div>
                <!-- BOTAO NOVO TELEFONE -->
                <button onclick="novo_telefone()" type="button" id="add_campo_telefone" class="btn btn-secondary">+</button>
                <button onclick="novos_registros()" type="button" form="novos_dados" class="btn btn-danger">Confirmar</button>
            </form>
        </div>
    </div>
    <!-- FIM AREA DE REGISTRO DE NOVOS DADOS -->

</main>