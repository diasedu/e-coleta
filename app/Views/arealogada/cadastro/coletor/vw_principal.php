<!DOCTYPE html>
<html lang="pt-BR">

  <?= view('templates/vw_head', array('titulo' => $titulo)) ?>

<body>
  <?= view('templates/vw_menu') ?>

  <div style="margin: 20px 10px; padding: 5px;">
    <div class="border border-secondary rounded" style="padding: 20px;">
      <div class="border-bottom-0">
        <span class="badge badge-dark" ><i class="fa-solid fa-filter"></i> Filtros</span>
        <hr>
      </div>

      <form action="" id="filtros">
        <div class="row">
          <div class="col-1">
            <label for="filt_id_usua">ID</label>
            <input type="number" name="filt_id_usua" id="filt_id_usua" class="form-control">
          </div>

          <div class="col-4">
            <label for="filt_nm_usua">Nome</label>
            <input type="text" name="filt_nm_usua" id="filt_nm_usua" class="form-control">
          </div>

          <div class="col-1">
            <label for="filt_sta_usua">Status</label>
            <select name="filt_sta_usua" id="filt_sta_usua" class="form-control">
              <option value=""></option>
              <option value="A">Ativo</option>
              <option value="I">Inativo</option>
            </select>
          </div>

          <div class="col-2">
            <button type="submit" class="btn btn-dark" style="margin-top: 30px" data-toggle="tooltip" data-placement="top" title="Consultar.">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="border border-secondary rounded" style="margin-top: 10px; padding: 20px;" id="info">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active"
            id="lista-tab"
            data-toggle="pill"
            data-target="#lista"
            type="button"
            role="tab"
            aria-controls="lista"
            aria-selected="true"
            onclick="habilitarFiltros(); $('form#filtros').submit();"
          >
            Lista
          </button>
        </li>

        <li class="nav-item" role="presentation">
          <button class="nav-link" id="cadastro-tab" data-toggle="pill" data-target="#cadastro" type="button" role="tab" aria-controls="cadastro" aria-selected="false" onclick="desabilitarFiltros()">
            Cadastrar
          </button>
        </li>
      </ul>

      <!-- Conteúdo das abas -->
      <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="lista" role="tabpanel" aria-labelledby="lista-tab">
          <div class="border border-secondary rounded" style="padding: 20px;">
            <div id="list"></div>
          </div>
        </div>

        <div class="tab-pane fade" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
          <div class="border border-secondary rounded" style="padding: 20px;">

            <form id="form-cadastro">
              <div class="row">
                <div class="col">
                  <a class="btn btn-sm btn-secondary" onclick="limparForm();" data-toggle="tooltip" data-placement="top" title="Resetar o formulário.">
                    <i class="fa-solid fa-broom"></i>
                  </a>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <input type="hidden" id="id_usua" name="id_usua">
                    <label for="nm_usua">Nome <i class="fa-solid fa-circle-info" data-toggle="tooltip" data-placement="top" title="Nome do coletor em até 30 caracteres."></i></label>
                    <input type="text" class="form-control" id="nm_usua" name="nm_usua">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="login_usua">E-mail <i class="fa-solid fa-circle-info" data-toggle="tooltip" data-placement="top" title="E-mail em até 30 caracteres."></i></label>
                    <input type="email" class="form-control" id="login_usua" name="login_usua">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="senha_usua">Senha <i class="fa-solid fa-circle-info" data-toggle="tooltip" data-placement="top" title="Senha em até 4.000 caracteres."></i></label>
                    <input type="password" class="form-control" id="senha_usua" name="senha_usua">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-2">
                  <div class="form-group">
                    <label for="sta_usua">Status</label>
                      <select class="form-control" id="sta_usua" name="sta_usua">
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                      </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <button type="submit" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Gravar" style="margin-top: 30px">
                    <i class="fa-solid fa-floppy-disk"></i>
                  </button>

                  <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir" style="margin-top: 30px; display: none;" id="btnExcluir">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div id="formMsg"></div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa-solid fa-trash-can"></i> Confirmar exclusão</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Deseja confirmar a exclusão do registro <span class="badge badge-danger" id="infoExcluiRegistro"></span></p>

              <div id="modalMsg"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
              <button type="button" class="btn btn-danger" id="btnConfirmaExclusao">Sim</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  <div>

  <script>
    $(function()
    {
      $('[data-toggle="tooltip"]').tooltip();

      $('form#filtros').on('submit', function(e)
      {
        e.preventDefault();

        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: 'coletor/consultar',
          data: $(this).serialize(),
          cache: false,
          beforeSend: function()
          {
            $('#list').html('<i class="fa-solid fa-spinner fa-spin"></i>');
          },
          success: function(jsonRes)
          {
            $('#list').html(jsonRes['html']);

            $('[data-toggle="tooltip"]').tooltip();
          },
          complete: function(xhr, ajaxOptions, throwError)
          {
            console.log(xhr, ajaxOptions, throwError);
          }
        })

      });

      $('form#filtros').submit();

      $('form#form-cadastro').on('submit', function(e)
      {
        e.preventDefault();

        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: 'coletor/inserirAtualizar',
          data: $(this).serialize(),
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

            limparForm();
          },
          error: function(xhr, ajaxOptions, throwError)
          {
            console.log(xhr, ajaxOptions, throwError);
          },
          complete: function()
          {
            $(e).prop('disabled', true);
          }
        })

      });

      $('#btnExcluir').on('click', function(e)
      {
        e.preventDefault();

        $('#infoExcluiRegistro').html($('#nm_usua').val());

        $('.modal').modal('show');
      });

      $('#btnConfirmaExclusao').on('click', function()
      {
        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: 'coletor/excluir',
          data: {
            id_usua: $('#id_usua').val()
          },
          cache: false,
          beforeSend: function()
          {
            $(this).prop('disabled', true);

            $('#modalMsg').html('<i class="fa-solid fa-spinner fa-spin"></i>');
          },
          success: function(jsonRes)
          {
            $(this).prop('disabled', false);

            $('#modalMsg').html(jsonRes['msg']);

            if (jsonRes['level'] == 'ERROR')
            {
              return;
            }

            $('#lista-tab').click();

            limparForm();
          },
          error: function(xhr, ajaxOptions, throwError)
          {
            console.log(xhr, ajaxOptions, throwError);
          },
          complete: function()
          {

            $('.modal').modal('hide');

            $('#infoExcluiRegistro').html('');
          }
        });
      });
    });

    const limparForm = function()
    {
      $('form#form-cadastro').children().children().children().children().val('');

      $('#btnExcluir').hide();
    }

    const abrirFormAtualizar = function(elemento)
    {
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'coletor/resgataRegistro',
        data: { filt_id_usua: $(elemento).attr('attr-id_usua') },
        cache: false,
        beforeSend: function()
        {
          $(elemento).prop('disabled', true);

          //$('#formMsg').html('<i class="fa-solid fa-spinner fa-spin"></i>');
        },
        success: function(jsonRes)
        {
          $(elemento).prop('disabled', false);

          if (jsonRes['level'] == 'ERROR')
          {
            return;
          }

          $('#btnExcluir').show();

          $('#id_usua').val(jsonRes['registro']['id_usua']);
          $('#nm_usua').val(jsonRes['registro']['nm_usua']);
          $('#sta_usua').val(jsonRes['registro']['sta_usua']);

          $('#cadastro-tab').click();
        },
        error: function(xhr, ajaxOptions, throwError)
        {
          console.log(xhr, ajaxOptions, throwError);
        },
        complete: function()
        {
          $(elemento).prop('disabled', false);
        }
      });
    }

    const habilitarFiltros = function()
    {
      $('form#filtros').children().children().children().prop('disabled', false);
    }

    const desabilitarFiltros = function()
    {
      $('form#filtros').children().children().children().prop('disabled', true);
    }

  </script>
</body>
</html>