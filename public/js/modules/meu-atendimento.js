const MSG_ERRO = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-xmark"></i> Ops, houve um imprevisto. Por gentileza, tente novamente mais tarde.</div';

$(function()
{
    $('[data-toggle=tooltip').tooltip();

    $('#btnConsult').click(function()
    {
        consultar();
    });

    $('#btnGravar').click(function(e)
    {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'meuAtendimento/mudarStatus',
            data: {
                id_ticket: $('#id_ticket').val(),
                id_sta_ticket: $('#id_sta_ticket').val()
            },
            cache: false,
            beforeSend: function()
            {
                $(e).prop('disabled', true);

                $('#formMsg').html('<i class="fa-solid fa-spinner fa-spin"></i>');
            },
            success: function(jsonRes)
            {
                $('#formMsg').html(jsonRes['msg']);

                if (jsonRes['level'] == 'ERROR')
                {
                    return;
                }

                $('#modalRegistro').modal('hide');

                consultar();
            },
            error: function(xhr, ajaxOptions, throwError)
            {
                console.log(xhr, ajaxOptions, throwError);
            },
            complete: function()
            {
                $(e).prop('disabled', true);
            }
        });

    });

    $('#id_sta_ticket').change(function()
    {
        const desativado = ($('#id_sta_ticket').val() == '' ? true : false);

        if (desativado)
        {
            const msg = gerarDivWarning('Informe o status para habilitar o botão "Gravar".');

            $('#formMsg').html(msg);
        } else 
        {
            $('#formMsg').html('');
        }

        $('#btnGravar').prop('disabled', desativado);
    });
});

const consultar = function()
{
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: 'meuAtendimento/consultar',
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
        url: 'meuAtendimento/ver',
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

            $('#id_ticket').val(registro['id_ticket']);
            $('#titulo').val(registro['nm_ticket']);
            $('#descricao').val(registro['desc_ticket']);
            $('#id_sta_ticket').val(registro['id_sta_ticket']).prop('disabled', false);
            $('#cep').val(registro['cep']);
            $('#logradouro').val(registro['logradouro']);
            $('#bairro').val(registro['bairro']);
            $('#numero').val(registro['numero']);
            $('#complemento').val(registro['complemento']);
            $('#cidade').val(registro['cidade']);
            $('#uf').val(registro['estado']);
            $('#data').val(registro['dt_html']);
            $('#dif').val(registro['dif']);

            if ($('#id_sta_ticket').val() != '')
            {
                $('#btnGravar').prop('disabled', false);
                $('#formMsg').html('');
            } else
            {
                $('#btnGravar').prop('disabled', true);
                $('#formMsg').html(gerarDivWarning('Informe o status para habilitar o botão "Gravar".'));
            }
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

const gerarDivWarning = function(msg)
{
    return `<div class="alert alert-warning" role="alert"><i class="fa-solid fa-xmark"></i> ${msg}</div>`;
}

consultar();