<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!--<a class="navbar-brand" href="#">Navbar</a>-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= base_url('arealogada/principal') ?>"><i class="fa-solid fa-recycle"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item<?= ($_SERVER['PATH_INFO'] == '/arealogada/principal' ? ' active' : '' ) ?>">
          <a class="nav-link" href="<?= base_url('arealogada/principal') ?>">
            <i class="fa-solid fa-house"></i> Início
          </a>
        </li>

        <?php
          if (session()->get('id_perfil') == 1)
          { 
            $listPath = ['/arealogada/admin/cadastro/coletor', '/arealogada/admin/cadastro/usuarioPerfil'];
            ?>
            <li class="nav-item dropdown <?= (in_array($_SERVER['PATH_INFO'], $listPath) ? 'active' : '' )?>">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-registered"></i> Cadastros
              </a>
              
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?= base_url('arealogada/admin/cadastro/usuarioPerfil') ?>"><i class="fa-solid fa-users-gear"></i> Usuário e perfil</a>
                
              </div>
            </li>
          <?php }
        
          if (session()->get('id_perfil') == 2)
          { ?>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('arealogada/solicitante/ticket') ?>"><i class="fa-solid fa-ticket-simple"></i> Ticket</a>
            </li>
          <?php
          } 

          if (session()->get('id_perfil') == 3)
          { ?>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('arealogada/coletor/solicitacaoAberta') ?>"><i class="fa-solid fa-hand"></i> Solicitações abertas</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('arealogada/coletor/meuAtendimento') ?>"><i class="fa-solid fa-person-walking"></i> Meus atendimentos</a>
            </li>
          <?php
          } 
        ?>
        
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('login/logout') ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sair</a>
        </li>
      </ul>

      <span class="badge badge-light"><?= session()->get('nm_usua') ?></span>
    </div>
  </nav>
  <!-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa-solid fa-address-card"></i> Cadastros</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Separated link</a>
      </div>

      <a class="nav-link" href="#">Pricing</a>
      <a class="nav-link" href="<?= base_url('login/logout') ?>">Sair</a>
    </div>
  </div> -->
</nav>