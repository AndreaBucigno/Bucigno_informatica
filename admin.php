<?php
require_once __DIR__ . "/config/database.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $sql = "SELECT * FROM utenti";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $filename = 'users.json';
    header('Content-Type: application/json; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . strlen($output));
    echo $output;
    exit();
  } catch (PDOException $e) {
    http_response_code(500);
    $msg = 'Errore DB: ' . htmlspecialchars($e->getMessage());
    echo '<div style="padding:16px;background:#f8d7da;color:#842029;border:1px solid #f5c2c7;border-radius:4px;">' . $msg . '</div>';
    exit();
  }

}


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

  </ul>

  <hr>

  <div class="dropdown">
    <a href="#" class="profile-toggle dropdown-toggle" data-bs-toggle="dropdown">
      <img src="" width="32" height="32" class="rounded-circle">
      <strong>Admin</strong>
    </a>

    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="login.php">Esci</a></li>
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
    <form action="admin.php" method="post">
      <button type="submit" class="btn btn-primary btn-lg login-button">
        Scarica json
      </button>
    </form>
      
    </div>

  </div>
</main>
';

$template = file_get_contents("inc/admin_template.inc.php");

$template = str_replace("{{title}}", $title, $template);
$template = str_replace("{{sidebar}}", $sidebar, $template);
$template = str_replace("{{body}}", $body, $template);

echo $template;
