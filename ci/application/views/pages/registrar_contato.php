<style>
    .tela_registro {
        display: flex;
        height: 500px;
        align-items: center;
        margin-left: 50px;
    }

    .tela_registro_interna {
        width: 500px
    }

    .dados_novos {
        position: absolute;
        right: 50px;
    }

    .form-control-sm {
        width: 500px;
    }
</style>
<script>
    $(document).ready(function() {
        var event_data = '';
        $.ajax({
            url: '<?= base_url() ?>grupo/lista_grupos',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                $.each(data, function(key, value) {
                    event_data = '<option value="' + value.id + '">' + value.descricao + '</option>';
                    $('#grupo').append(event_data);
                });
            }
        })
    });

    function novo_email() {
        // $("#email_div").append('<label for="exampleInputEmail1">Endereço de email</label><input id="email" type="text" class="form-control email_" placeholder="Novo E-mail" name="email[]">');
        $dados = $("#email").val();
        $(".emails_novos").append($dados + "</br>");
    };

    function novo_telefone() {
        // $("#telefone_div").append('<label for="exampleInputPassword1">Telefone</label> <input id="telefone" name="telefone" placeholder="Novo Telefone" type="tel" class="form-control telefone_">');
        $dados = $("#telefone").val();
        $(".telefones_novos").append($dados + "</br>");
    };

    function registra() {
        let email = new Array();
        let telefone = new Array();
        var contato = $('#contato').val();
        var grupo = $('#grupo').val();
        $('.email_').each(function() {
            var length = $(this).val().length;
            if (!length < 1) {
                email.push($(this).val());
            }
        });
        $('.telefone_').each(function() {
            telefone.push($(this).val());
        });
        $.ajax({
            url: '<?= base_url() ?>contato/store',
            type: 'post',
            dataType: 'json',
            data: {
                contato: contato,
                email: email,
                grupo: grupo,
                telefone: telefone
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
    $("#telefone").mask("(00) 0000-00009");
</script>
<h1><?= $title ?></h1>
<div class="tela_registro">
    <div class="tela_registro_interna">
        <form id="registro">
            <div class="form-group alert"></div>
            <div class="grid">
                <div class="">

                    <div id="contato_div" class="form-group">
                        <label>Nome do Contato</label>
                        <input id="contato" name="contato" placeholder="Seu Nome" type="text" class="form-control">
                    </div>
                    <div id="grupo_div" class="form-group">
                        <label for="exampleInputPassword1">Grupo</label></br>
                        <select id="grupo" name="grupo" class="form-control-sm"></select>
                    </div></br>
                </div>
                <div class="">
                    <div id="email_div" class="form-group">
                        <label for="exampleInputEmail1">Endereço de email</label>
                        <input id="email" type="email" class="form-control email_" placeholder="exemplo@exemplo.com" name="email[]">
                    </div>
                    <!-- botão adicionar novo e-mail -->
                    <button onclick="novo_email()" type="button" id="add_campo_email" class="btn btn-secondary">+</button>
                    <div id="telefone_div" class="form-group">
                        <label for="exampleInputPassword1">Telefone</label>
                        <input id="telefone" name="tel[]" placeholder="Seu Telefone" type="tel" class="form-control telefone_" pattern="([0-9]{2})[s](0-9){4}-(0-9){4,5}">
                    </div>
                    <!-- botão adicionar novo telefone -->
                    <button onclick="novo_telefone()" type="button" id="add_campo_telefone" class="btn btn-secondary">+</button>
                </div>
            </div>

            <button type="button" form="registro" onclick="registra()" class="btn btn-success">Registrar</button>
        </form>
    </div>
    <div class="form-group dados_novos">
        <div class="emails_novos"></div>
        <div class="telefones_novos"></div>
    </div>
</div>