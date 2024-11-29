<!DOCTYPE html>
<html lang="pt-BR">

  <?= view('templates/vw_head', array('titulo' => $titulo)) ?>

<body>
  <?= view('templates/vw_menu') ?>
  <div style="margin: 30px;">
    <form id="formCriarSolicitacao">
      <span class="badge bg-info">
        <i class="fa-solid fa-circle-info"></i> Informações
      </span>
      <hr>

      <div class="form-row">
        <div class="col">
          <label for="titulo">Título</label>
          <input type="text" class="form-control" id="titulo" name="titulo">
          <small class="form-text text-muted">
            <i class="fa-solid fa-handshake-angle"></i> O título deve conter até 30 caracteres.
          </small>
          <div id="tituloInfo"></div>
        </div>
      </div>

      <div class="form-row">
        <div class="col">
          <label for="descricao">Descrição</label>
          <textarea id="descricao" name="descricao" class="form-control"></textarea>
          <small class="form-text text-muted">
            <i class="fa-solid fa-handshake-angle"></i> Conte mais detalhes sobre a sua situação em até 200 caracteres.
          </small>
          <div id="descricaoInfo"></div>
        </div>
      </div>

      <br>
      <span class="badge bg-info">
        <i class="fa-solid fa-location-dot"></i> Endereço
      </span>
      <hr>
      <div class="form-row">
        <div class="col-2">
          <label for="cep">CEP</label>
          <input type="text" class="form-control" id="cep" name="cep" style="display: inline;" placeholder="Layout de CEP: 00000-000" maxlength="9">
        </div>
        <a class="btn btn-sm btn-info" onclick="consultarCep(this);" style="margin: 35px 5px;"><i class="fa-solid fa-magnifying-glass"></i></a>
      </div>

      <div id="cepInfo"></div>

      <div id="formEndereco" style="display: none;">
        <div class="form-row">
          <div class="col-5">
            <label for="logradouro">Logradouro</label>
            <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Av. Ipiranga">
          </div>

          <div class="col-2">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro">
          </div>

          <div class="col-1">
            <label for="numero">Número</label>
            <input type="number" class="form-control" id="numero" name="numero">
          </div>

          <div class="col-4">
            <label for="complemento">Complemento</label>
            <input type="number" class="form-control" id="complemento" name="complemento">
          </div>
        </div>

        <div class="form-row">

          <div class="col-2">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade">
          </div>

          <div class="col-2">
            <label for="uf">UF</label>
            <input type="text" class="form-control" id="uf" name="uf" maxlength="2">
          </div>

        </div>

        <div id="enderecoInfo"></div>

      </div>

      <br>
      <hr>

      <div class="row">
        <div class="col">
          <div id="formInfo"></div>
        </div>
      </div>

      <button type="button" class="btn btn-success" style="float: right;" id="btnGravar" disabled>
        <i class="fa-solid fa-floppy-disk"></i> Registrar
      </button>
    </form>
  </div>

  <script>
    $(function()
    {
      $('#btnGravar').click(function()
      {
        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: 'solicitarColeta/criarSolicitacao',
          data: {
            titulo: $('#titulo').val(),
            descricao: $('#descricao').val(),
            cep: $('#cep').val(),
            logradouro: $('#logradouro').val(),
            bairro: $('#bairro').val(),
            numero: $('#numero').val(),
            complemento: $('#complemento').val(),
            cidade: $('#cidade').val(),
            uf: $('#uf').val()
          },
          cache: false,
          beforeSend: function()
          {
            $(this).prop('disabled', true);

            $('#formInfo').html('<i class="fa-solid fa-spinner fa-spin"></i>');
          },
          success: function(jsonRes)
          {
            if (jsonRes['level'] == 'ERROR')
            {
              $(jsonRes['field']).focus();
              $(jsonRes['fieldInfo']).html(jsonRes['msg']);
              $('#formInfo').html('');

              return;
            }

            $(jsonRes['fieldInfo']).html('');
            
            $('#formInfo').html(jsonRes['msg']);
          },
          error: function(xhr, ajaxOptions, throwError)
          {
            console.log(xhr, ajaxOptions, throwError);
          },
          complete: function()
          {
            $(this).prop('disabled', false);           
          }
        });
      });
    });

    const consultarCep = function(e)
    {
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'solicitarColeta/consultarCep',
        data: {
          cep: $('#cep').val()
        },
        cache: false,
        beforeSend: function()
        {
          $(e).prop('disabled', true);

          $('#cepInfo').html('<i class="fa-solid fa-spinner fa-spin"></i>');
        },
        success: function(jsonRes)
        {
          $('#cepInfo').html(jsonRes['msg']);
          

          if (jsonRes['level'] == 'ERROR')
          {
            return;
          }

          $('#logradouro').val(jsonRes['list']['logradouro']).prop('disabled', true);
          $('#bairro').val(jsonRes['list']['bairro']).prop('disabled', true);
          $('#cidade').val(jsonRes['list']['cidade']).prop('disabled', true);
          $('#uf').val(jsonRes['list']['uf']).prop('disabled', true);

          $('#formEndereco').css('display', 'block');
          $('#btnGravar').prop('disabled', false);

          $('#cepInfo').html('');

        },
        error: function(xhr, ajaxOptions, throwError)
        {
          console.log(xhr, ajaxOptions, throwError);
        },
        complete: function()
        {
          $(e).prop('disabled', false);
        }
      });
    }
  </script>
  
</body>
</html>