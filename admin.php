<?php
$title = "Dashboard";
$sidebar = '
<aside class="wblw-sidebar d-flex flex-column flex-shrink-0 p-3">

  <a href="admin.php" class="sidebar-brand mb-3">
    <img src="assets/images/Logo.png" class="Logo" alt="Logo">
    <span class="sidebar-brand-title">ADMIN page</span>
  </a>

  <hr>

  <ul class="nav nav-pills flex-column mb-auto">

    <li class="nav-item">
      <a href="admin.php" class="nav-link active">
        <i class="bi bi-speedometer2"></i>
        Dashboard
      </a>
    </li>

    <li class="nav-item">
      <a href="admin_utenti.php" class="nav-link">
        <i class="bi bi-people"></i>
        Gestisci Utenti
      </a>
    </li>

    <li class="nav-item">
      <a href="admin_segnalazioni.php" class="nav-link">
        <i class="bi bi-flag"></i>
        Segnalazioni
      </a>
    </li>


  </ul>

  <hr>

  <div class="dropdown">
    <a href="#" class="profile-toggle dropdown-toggle" data-bs-toggle="dropdown">
      <img src="" width="32" height="32" class="rounded-circle">
      <strong>Admin</strong>
    </a>

    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="admin_profilo.php">Profilo</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="logout.php">Esci</a></li>
    </ul>
  </div>

</aside>
';


$body = '
<main class="wblw-content">

  <h1 class="hero-wblw-title mb-2">Dashboard</h1>
  <p class="hero-wblw-desc mb-4">Panoramica rapida dell\'area admin.</p>

  <div class="p-3 rounded-3 mb-4"
       style="background: var(--dark-contrast); border: 1px solid var(--border-color);">

    <div class="d-flex align-items-center gap-2 mb-2">
      <i class="bi bi-table"></i>
      <strong>DEVO COSTRUITRE LA TABELLA CON LE INFO PRESE DAL DB</strong>
    </div>

  </div>
</main>
';

$template = file_get_contents("inc/admin_template.inc.php");

$template = str_replace("{{title}}", $title, $template);
$template = str_replace("{{sidebar}}", $sidebar, $template);
$template = str_replace("{{body}}", $body, $template);

echo $template;
