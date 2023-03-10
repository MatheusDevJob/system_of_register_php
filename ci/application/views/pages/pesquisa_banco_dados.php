<script>
    $(document).ready(function() {
        busca_nome();
    });

    function busca_nome(inicio = 0) {
        var nome = $('#busca').val();
        $.ajax({
            url: '<?= base_url() ?>contato/pesquisa_contatos',
            type: 'POST',
            dataType: 'json',
            data: {
                nome: nome,
                inicio: inicio,
            },
            success: function(data) {
                var event_data = '';
                var dados = '';
                $.each(data.registros, function(index, value) {
                    event_data += "<tr><td>" + value.contato_id + "</td>";
                    event_data += '<td>' + value.nome + '</td> ';
                    event_data += '<td>' + value.email + '</td>';
                    event_data += '<td>' + value.telefone + '</td>';
                    event_data += ' <td>' + value.descricao + '';
                    event_data += '<td><a href="<?= base_url() ?>contato/editar/' + value.contato_id + '" class="btn btn-sm btn-warning">Edit</a></td></tr>';
                });
                $("busca_nome tbody").html(event_data);

                $("#divNavegacao").html('');
                var botaoNevegacao = '';
                if (data.numPaginas > 1) {
                    console.log(data.navegacao);
                    botaoNevegacao += ' <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">';
                    botaoNevegacao += '<div class="btn-group mr-2" role="group" aria-label="First group">';
                    if (data.navegacao.anterior != null) {

                        botaoNevegacao += '<button type="button" style="padding: 9px 8px;" class="btn btn-secondary" onclick="busca_nome(' + data.navegacao.anterior + ')"><span class="glyphicon glyphicon-backward"></span><</button>';
                    }

                    $.each(data.numDaPagina, function(index, value) {
                        paginaAtual = data.inicio == value ? "disabled" : '';
                        paginaVazia = Math.ceil(data.numPaginas) < data.indexDaPagina + index ? "disabled" : '';
                        if (!paginaVazia) {
                            botaoNevegacao += ' <button type="button" ' + paginaAtual + ' class="btn btn-secondary" onclick="busca_nome(' + value + ')">' + (data.indexDaPagina + index) + '</button>';
                        }
                    });
                    if (data.navegacao.proximo != null) {
                        botaoNevegacao += '<button type="button"  class="btn btn-secondary" style="padding: 9px 8px;" onclick="busca_nome(' + data.navegacao.proximo + ')"><span class="glyphicon glyphicon-forward"></span>></button>';
                    }
                    botaoNevegacao += '</div>';
                    botaoNevegacao += '</div>';
                    botaoNevegacao += '<p>';
                }

                $("#divNavegacao").html(botaoNevegacao);
                $("#divNavegacao2").html(botaoNevegacao);

                if (event_data != '') {
                    $("#busca_nome tbody").html('');
                    $("#busca_nome tbody").append(event_data);

                } else {
                    $("#busca_nome tbody").html('');
                    $("#busca_nome tbody").append('Nenhum Funcion??rio encontrado');
                }
            },
        });
    }
</script>
<div class="container-fluid alert alert-dark">

    <div class="row justify-content-md-center">
        <div class="col-sm-11">
            <h1><?= $title ?></h1>
        </div>
    </div>
    <div class="row justify-content-md-center">

    </div>
    <br>
    <div class="row justify-content-md-center">
        <div class="col-sm-3">
            <div id="divNavegacao"></div>
        </div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
            <input type="text" class="form-control" placeholder="Quem buscas?" name="busca" id="busca">
        </div>
        <div class="col-sm-1">
            <button type="button" form="pesquisar_nome" class="btn btn-info" onclick="busca_nome()">Pesquisar</button>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-11">
            <table id="busca_nome" class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">bot??o</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-11">
            <div id="divNavegacao2"></div>
        </div>
    </div>
</div>