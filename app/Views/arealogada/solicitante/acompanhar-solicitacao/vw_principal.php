<!DOCTYPE html>
<html lang="pt-BR">

  <?= view('templates/vw_head', array('titulo' => $titulo)) ?>

<body>
  <?= view('templates/vw_menu') ?>

  <div style="margin: 30px;">
    <h3>
      <i class="fa-solid fa-chalkboard-user"></i> Acompanhar solicitação
    </h3>

    <div class="jumbotron">
      <form id="formFilt">
        <h6>
          <i class="fa-solid fa-filter"></i> Filtros
        </h6>

        <div class="form-row">

          <div class="col">
            <input type="number" name="filt_id_ticket" class="form-control" placeholder="Número do ticket">
          </div>

          <div class="col">
            <input type="text" name="filt_nm_ticket" class="form-control" placeholder="Nome do ticket">
          </div>

          <div class="col">
            <input type="date" id="filt_dt_incl_ticket" name="filt_dt_incl_ticket" class="form-control" placeholder="Data do ticket">
          </div>

          <div class="col">
            <select name="filt_id_sta_ticket" class="form-control">
              <option value="" hidden selected class="mute">Filtre pelo status do ticket</option>

              <?php 
                if ($listStaTicket['level'] == 'ERROR')
                { ?>
                  <option value="" disabled selected>
                    <?= $listStaTicket['msg'] ?>
                  </option>
                  <?php
                }

                foreach ($listStaTicket['list'] as $row)
                { ?>
                  <option value="<?= $row['id_sta_ticket'] ?>">
                    <?= $row['nm_sta_ticket'] ?>
                  </option>
                  <?php
                }
              ?>
            </select>

          </div>

          <div class="col">
            <button 
              type="button" 
              class="btn btn-dark" 
              data-toggle="tooltip" data-placement="top" title="Consultar."
              id="btnConsult"
            >
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <div id="list"></div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalRegistro" data-keyboard="false" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRegistroLabel"><i class="fa-solid fa-clipboard"></i> Informações do Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formConsult">
            <h6><i class="fa-solid fa-circle-info"></i> Informações</h6>
            <hr>

            <div class="form-row">
              <div class="col">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" disabled>
              </div>

              <div class="col-4">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" disabled>
              </div>

              <div class="col-2">
                <label for="dif">
                  Dif. 
                  <i 
                    class="fa-solid fa-circle-info"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Diferença em dias entre a data da solicitação e atual."  
                  ></i></label>
                <input type="number" class="form-control" id="dif" name="dif" disabled>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-control" disabled></textarea>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="id_sta_ticket">Status</label>
                <select class="form-control" id="id_sta_ticket" name="id_sta_ticket" disabled>
                  <?php
                    if ($listStaTicket['level'] == 'ERROR')
                    { ?>
                      <option value=""><?= $listStaTicket['msg']
                      ?></option>
                      <?php
                    }

                    foreach ($listStaTicket['list'] as $row)
                    { ?>
                      <option value="<?= $row['id_sta_ticket'] ?>"><?= $row['nm_sta_ticket'] ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>

            <br>

            <h6><i class="fa-solid fa-location-dot"></i> Endereço</h6>
            <hr>

            <div class="form-row">
              <div class="col">
                <label for="logradouro">Logradouro</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro" disabled>
              </div>

              <div class="col">
                <label for="numero">Número</label>
                <input type="number" class="form-control" id="numero" name="numero" disabled>
              </div>

            </div>

            <div class="form-row">
              <div class="col">
                <label for="complemento">Complemento</label>
                <input type="number" class="form-control" id="complemento" name="complemento" disabled>
              </div>

              <div class="col">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" disabled>
              </div>

              <div class="col">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" style="display: inline;" disabled>
              </div>

            </div>

            <div class="form-row">

              <div class="col">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" disabled>
              </div>

              <div class="col">
                <label for="uf">UF</label>
                <input type="text" class="form-control" id="uf" name="uf" disabled>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('public/js/modules/acompanhar-solicitacao.js') ?>"></script>
</body>
</html>