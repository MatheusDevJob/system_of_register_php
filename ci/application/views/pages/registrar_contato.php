<style>
    input {
        border: none;
    }

    #body {
        margin-top: 1em;
    }

    .form-group {
        margin-bottom: 3px;
    }

    form {
        margin-top: 6%;
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
        $(".alert_campos_adicionais").html('');
        if ($dados != null && $dados != '') {
            $("#email").val('');
            $(".emails_novos").append('<input class="email_novo" readonly value="' + $dados + '"></br>');
        } else {
            $(".alert_campos_adicionais").append('<div class="alert alert-danger">E-mail não pode ser vazio.</div>');
        }

    };

    function novo_telefone() {
        // $("#telefone_div").append('<label for="exampleInputPassword1">Telefone</label> <input id="telefone" name="telefone" placeholder="Novo Telefone" type="tel" class="form-control ">');
        $dados = $("#telefone").val();
        $(".alert_campos_adicionais").html('');
        if ($dados != null && $dados != '') {
            $("#telefone").val('');
            $(".telefones_novos").append('<input class="telefone_novo" readonly value="' + $dados + '"></br>');
        } else {
            $(".alert_campos_adicionais").append('<div class="alert alert-danger">Telefone não pode ser vazio.</div>');
        }

    };

    function registra() {
        let email = new Array();
        let telefone = new Array();
        var contato = $('#contato').val();
        var grupo = $('#grupo').val();

        $('.email_novo').each(function() {
            email.push($(this).val());
        });
        $('.telefone_novo').each(function() {
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
                $(".alert_registro").html('');
                $(".alert_registro").append('<div class="alert alert-primary" role="alert">Registrado com Sucesso!</div>');
            },
            error: function(d) {
                $(".alert_registro").html('');
                $(".alert_registro").append('<div class="alert alert-primary" role="alert">Falha ao Registrar</div>');
            }
        });
    }
    $("#telefone").mask("(00) 00000-0009");
</script>
<form>
    <div id="body" class="container alert alert-dark">
        <h1><?= $title ?></h1>
        <div class="alert_registro" style="padding: 0;"></div>
        <div class="alert_campos_adicionais" style="padding: 0;"></div>
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="staticEmail">Nome do Contato</label>
            </div>
            <div class="col-sm-9">
                <input id="contato" name="contato" placeholder="Seu Nome" type="text" class="form-control ">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="exampleInputPassword1">Grupo</label></br>
            <div class="col-sm-9">
                <select id="grupo" name="grupo" class="form-control"></select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="exampleInputEmail1">Endereço de email</label>
            <div class="col-sm-9">
                <input id="email" type="email" class="form-control email_" placeholder="exemplo@exemplo.com" name="email[]">
            </div>
            <div class="col-sm-1">
                <button onclick="novo_email()" type="button" id="add_campo_email" class="btn btn-secondary">+</button>
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-9">
                <input id="telefone" name="tel[]" placeholder="Seu Telefone" type="tel" class="form-control telefone_" pattern="([0-9]{2})[s](0-9){4}-(0-9){4,5}">
            </div>
            <div class="col-sm-1">
                <button onclick="novo_telefone()" type="button" id="add_campo_telefone" class="btn btn-secondary">+</button>
            </div>
        </div>
        <br>
        <button type="button" form="registro" onclick="registra()" class="btn btn-success">Registrar</button>
        <br> <br>
        <div class="form-group row">
            <div class="col">
                <label for="exampleInputPassword1" class="col-form-label">E-mails Adicionais</label>
                <div class="emails_novos"></div>
            </div>
            <div class="col">
                <label for="exampleInputPassword1" class="col-form-label">Telefones Adicionais</label>
                <div class="telefones_novos"></div>
            </div>
        </div>
    </div>
</form>