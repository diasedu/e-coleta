const MSG_ERRO = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-xmark"></i> Ops, houve um imprevisto. Por gentileza, tente novamente mais tarde.</div';

$(function()
{
    $('[data-toggle=tooltip').tooltip();

    $('#btnConsult').click(function() {
        consultar();
    })
});

const consultar = function()
{
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: 'acompanharSolicitacao/consultar',
        data: $('form#formFilt').serialize(),
        cache: false,
        beforeSend: function()
        {
            $('#btnConsult').prop('disabled', true);

            $('#list').html('<i class="fa-solid fa-spinner fa-spin"></i>');
        },
        success: function(html)
        {
            $('#list').html(html);

            $('[data-toggle=tooltip').tooltip();
        },
        error: function(xhr, ajaxOptions, throwError)
        {
            $('#list').html(MSG_ERRO);

            console.log(xhr, ajaxOptions, throwError);
        },
        complete: function()
        {
            $('#btnConsult').prop('disabled', false);
        }
    });
}

const ver = function(e)
{
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'acompanharSolicitacao/ver',
        data: {
            id_ticket: $(e).attr('attr-id_ticket')
        },
        cache: false,
        beforeSend: function()
        {
            $(e).html('<i class="fa-solid fa-spinner fa-spin"></i>').prop('disabled', true);
        },
        success: function(json)
        {
            if (json['level'] == 'ERROR')
            {
                return;
            }

            $('form#formConsult')[0].reset();

            const registro = json['list'][0];

            $('#modalRegistro').modal('show');

            $('#titulo').val(registro['nm_ticket']);
            $('#descricao').val(registro['desc_ticket']);
            $('#id-sta_ticket').val(registro['id_sta_ticket'])
            $('#cep').val(registro['cep']);
            $('#logradouro').val(registro['logradouro']);
            $('#bairro').val(registro['bairro']);
            $('#numero').val(registro['numero']);
            $('#complemento').val(registro['complemento']);
            $('#cidade').val(registro['cidade']);
            $('#uf').val(registro['estado']);
            $('#data').val(registro['dt_html']);
            $('#dif').val(registro['dif']);

        },
        error: function(xhr, ajaxOptions, throwError)
        {
            $('#list').html(MSG_ERRO);

            console.log(xhr, ajaxOptions, throwError);
        },
        complete: function()
        {
            $(e).html('<i class="fa-solid fa-eye"></i>').prop('disabled', false);
        }
    });
}

consultar();