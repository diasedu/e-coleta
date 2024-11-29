<!DOCTYPE html>
<html lang="pt-BR">

  <?= view('templates/vw_head', array('titulo' => $titulo)) ?>

<body>
  <?= view('templates/vw_menu') ?>

  <style>
    .card-body:hover {
      opacity: 0.5;
    }
  </style>

  <div class="card-group">
    <div class="card" style="cursor: pointer;" id="cardSolicitar">
      
      <div class="card-body">
        <img src="<?= base_url('public/img/coleta.jpg') ?>" class="card-img-top" alt="...">
        <h5 class="card-title">Solicitar coleta</h5>
        <p class="card-text">Faça sua solicitação aqui.</p>
      </div>
    </div>
    <div class="card" style="cursor: pointer;" id="cardConsultSolicitacao">
      <div class="card-body">
        <img src="<?= base_url('public/img/lixo.jpg') ?>" class="card-img-top" alt="...">
        <h5 class="card-title">Minhas solicitações</h5>
        <p class="card-text">Acompanhe o andamento da sua solicitação.</p>
      </div>
    </div>
  </div>

  <script>
    $(function()
    {
      $('#cardSolicitar').click(function()
      {
        window.location = 'solicitarColeta';
      });

      $('#cardConsultSolicitacao').click(function()
      {
        window.location = 'acompanharSolicitacao';
      });
    });
  </script>
</body>
</html>