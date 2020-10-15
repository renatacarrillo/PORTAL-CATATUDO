<?php
$userName = $_SESSION['admin']['name'];
?>

<nav class="navbar navbar-dark bgColorPrimary">
  <div class="navbar-brand mb-0 logo">
    <span>CATA</span><span>TUDO</span>
    <small>admin</small>
  </div>
  <div class="navbar-expand">
    <ul class="navbar-nav">
      <li class="nav-item pr-2">
        <span class="navbar-text text-light">
          <?= $userName ?>
        </span>
      </li>
      <li class="nav-item">
        <a title="Sair" data-toggle="tooltip" data-placement="bottom" class="nav-link" href="?logout=true"><i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </div>
</nav>