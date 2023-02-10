<script>
    $(document).ready(function() {
        busca_nome();
    });

    function busca_nome(inicio = 0) {
        var nome = $('#busca').val();
        $.ajax({
            url: '<?= base_url() ?>contato/pesquisa',
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
                    $("#busca_nome tbody").append('Nenhum Funcionário encontrado');
                }
            },
        });
    }
</script>
<h1><?= $title ?></h1>
<form id="pesquisar_nome" method="POST">
    <input type="text" class="form-control" placeholder="Quem buscas?" name="busca" id="busca">
    <button type="button" form="pesquisar_nome" class="btn btn-info" onclick="busca_nome()">Pesquisar</button>
</form>
<table id="busca_nome" class="table table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Telefone</th>
            <th scope="col">Grupo</th>
            <th scope="col">botão</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<div id="divNavegacao"></div>