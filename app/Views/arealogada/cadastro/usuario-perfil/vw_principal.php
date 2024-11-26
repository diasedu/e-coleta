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

          <div class="col-2">
            <label for="filt_tipo_perfil">Status</label>
            <select name="filt_tipo_perfil" id="filt_tipo_perfil" class="form-control">
              <option value="">Escolha</option>
              <option value="A">Ativo</option>
              <option value="I">Inativo</option>
            </select>
          </div>

          <div class="col-2">
            <label for="filt_id_perfil">Tipo de perfil</label>
            <select class="form-control" id="filt_id_perfil" name="filt_id_perfil">
                <option value="">Escolha</option>
              <?php
              if (!empty($data['list_perfil']))
              {
                foreach ($data['list_perfil'] as $row)
                {
                ?>
                  <option value="<?= $row['id_perfil'] ?>"><?= $row['desc_perfil'] ?></option>
                  <?php
                }
              }
              ?>
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
      </ul>

      <!-- Conteúdo das abas -->
      <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="lista" role="tabpanel" aria-labelledby="lista-tab">
          <div class="border border-secondary rounded" style="padding: 20px;">
            <div id="list"></div>
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

      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">
                <i class="fa-solid fa-link"></i> Vincular o usuário a um perfil
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="form-cadastro">
                <div class="row">
                  <div class="col">
                    <a class="btn btn-sm btn-secondary" onclick="limparForm();" data-toggle="tooltip" data-placement="top" title="Resetar o formulário.">
                      <i class="fa-solid fa-broom"></i>
                    </a>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <input type="hidden" id="id_usua" name="id_usua">
                      <span class="badge badge-pill badge-info" id="html_nm_usua" style="font-size: 15px;"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="id_perfil">Perfil</label>
                        <select class="form-control" id="id_perfil" name="id_perfil">
                          <?php
                          if (!empty($data['list_perfil']))
                          {
                            foreach ($data['list_perfil'] as $row)
                            {
                            ?>
                              <option value="<?= $row['id_perfil'] ?>"><?= $row['desc_perfil'] ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div id="formMsg"></div>
                  </div>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fa-solid fa-rectangle-xmark"></i> Fechar
              </button>
              <button type="button" class="btn btn-dark" id="btnGravar">
                <i class="fa-solid fa-floppy-disk"></i> Gravar
              </button>
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
          url: 'usuarioPerfil/consultar',
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

      $('#btnGravar').on('click', function(e)
      {
        e.preventDefault();

        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: 'usuarioPerfil/vincularDesvincular',
          data: $('form#form-cadastro').serialize(),
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

            $('#editModal').modal('hide');

            limparForm();

            $('form#filtros').submit();
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
    });

    const limparForm = function()
    {
      $('form#form-cadastro').children().children().children().children().val('');

      $('#formMsg').html();
    }

    const abrirFormAtualizar = function(elemento)
    {
      const data = {
        filt_id_usua: $(elemento).attr('attr-id_usua')
      }

      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'usuarioPerfil/resgataRegistro',
        data: data,
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

          limparForm();

          $('#id_usua').val(jsonRes['list'][0]['id_usua']);
          $('#html_nm_usua').html(jsonRes['list'][0]['nm_usua']);
          $('#id_perfil').val(jsonRes['list'][0]['id_perfil']);

          $('#editModal').modal('show');
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
  </script>
</body>
</html>