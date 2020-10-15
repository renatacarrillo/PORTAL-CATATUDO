<?php
$url = $_SERVER["REQUEST_URI"];
$urlAtual = explode('/', $url);

?>
<aside class="sidenav">
  <nav class="menu">
    <a class="navItem <?= end($urlAtual) == 'dashboard.php' ? 'active' : ''  ?> " data-toggle="tooltip" data-placement="right" title="Dashboard" href="../administration/dashboard.php">
      <i class="fas fa-chart-bar"></i>
      <span class="sr-only">Dashboard</span>
    </a>
    <a class="navItem <?= end($urlAtual) == 'users.php' ? 'active' : ''  ?> " data-toggle="tooltip" data-placement="right" title="Usuários" href="../administration/users.php">
      <i class="fas fa-users"></i>
      <span class="sr-only">Usuários</span>
    </a>
    <a class="navItem <?= end($urlAtual) == 'collections.php' ? 'active' : ''  ?> " data-toggle="tooltip" data-placement="right" title="Coletas" href="../administration/collections.php">
      <i class="fas fa-recycle"></i>
      <span class="sr-only">Coletas</span>
    </a>
    <a class="navItem <?= end($urlAtual) == 'feeds.php' ? 'active' : ''  ?> " data-toggle="tooltip" data-placement="right" title="Feeds" href="../administration/feeds.php">
      <i class="fas fa-tags"></i>
      <span class="sr-only">Feeds</span>
    </a>
    <a class="navItem <?= end($urlAtual) == 'articles.php' ? 'active' : ''  ?> " data-toggle="tooltip" data-placement="right" title="Artigos" href="../administration/articles.php">
      <i class="fas fa-file-alt"></i>
      <span class="sr-only">Artigos</span>
    </a>
    <a class="navItem <?= end($urlAtual) == 'collector.php' ? 'active' : ''  ?> " data-toggle="tooltip" data-placement="right" title="Aprovar Coletores" href="../administration/collector.php">
      <i class="fas fa-id-card"></i>
      <span class="sr-only">Aprovar Coletores</span>
    </a>
  </nav>
</aside>