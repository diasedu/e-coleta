<nav class="navbar navbar-expand-lg navbar-light">
  <!--<a class="navbar-brand" href="#">Navbar</a>-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="<?= base_url('areaLogada/principal') ?>"><i class="fa-solid fa-house"></i> Início</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('areaLogada/principal') ?>">
            <i class="fa-solid fa-house"></i> Início<span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-registered"></i> Cadastros
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= base_url('areaLogada/cadastro/tipColeta/principal') ?>"><i class="fa-solid fa-recycle"></i> Tipo de coleta</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('login/logout') ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sair</a>
        </li>
        
      </ul>
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