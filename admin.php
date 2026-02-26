<?php
require_once __DIR__ . "/config/database.php";

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    // Se viene sottomesso il form di aggiunta utente
    if (isset($_POST['action']) && $_POST['action'] === 'add_user') {
      $email = $_POST['email'];
      $ruolo = $_POST['ruolo'];
      $password = $_POST['password'];

      $sql = "INSERT INTO utenti (email, ruolo, PSW) VALUES (:email, :ruolo, :password)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':email' => $email,
        ':ruolo' => $ruolo,
        ':password' => $password
      ]);

      $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">Utente aggiunto con successo!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    // Se viene sottomesso il form di download
    elseif (isset($_POST['action']) && $_POST['action'] === 'download') {
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
    }
  } catch (PDOException $e) {
    http_response_code(500);
    $message = 'Errore DB: ' . htmlspecialchars($e->getMessage());
    $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
  }
}


$title = "Dashboard";
$sidebar = '
<aside class="wblw-sidebar d-flex flex-column flex-shrink-0 p-3">

  <a href="admin.php" class="sidebar-brand mb-3">
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
    <a href="login.php" class="btn btn-prenota" style="background: #dc3545; border-color: #dc3545;">
      <i class="bi bi-box-arrow-right"></i> Logout
    </a>
  </div>

</aside>
';

// query utenti to populate table
$body = '
<main class="wblw-content">
  <h1 class="hero-wblw-title mb-2">Dashboard</h1>
  <p class="hero-wblw-desc mb-4">Panoramica rapida dell\'area admin.</p>
  ' . $message . '
  <div class="p-3 rounded-3 mb-4" style="background: var(--dark-contrast); border: 1px solid var(--border-color);">

    <h1 class="hero-wblw-title mb-2">Gestione Utenti</h1>
    <div class="table-responsive mb-4">
      <table class="dysplay table table-striped table-dark table-dark" id="usersTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Ruolo</th>
            <th>Creazione</th>
          </tr>
        </thead>
        <tbody>';

// execute select and fetch rows
$sql = "SELECT ID, email, ruolo, creation_tms FROM utenti";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) > 0) {
  foreach ($rows as $row) {
    $body .= '<tr>';
    $body .= '<td>' . htmlspecialchars($row['ID']) . '</td>';
    $body .= '<td>' . htmlspecialchars($row['email']) . '</td>';
    $body .= '<td>' . htmlspecialchars($row['ruolo']) . '</td>';
    $body .= '<td>' . htmlspecialchars($row['creation_tms']) . '</td>';
    $body .= '</tr>';
  }
} else {
  $body .= '<tr><td colspan="4">Nessun utente trovato.</td></tr>';
}

$body .= '
  </tbody>
</table>
</div>';



$body .= '
    <div class="d-flex align-items-left gap-2 mb-2">
    <form action="admin.php" method="post">
      <input type="hidden" name="action" value="download">
      <button type="submit" class="btn btn-primary btn-lg login-button">
        Scarica Database Utenti
      </button>
    </form>  
    </div>

    <hr class="hr" />
    <div class="d-flex align-items-left gap-2 mb-2">
      <button id="toggleAddUser" class="btn btn-primary btn-lg login-button">
      Aggiungi Nuovo Utente 
      <i class="bi bi-person-plus-fill"></i>
      </button>
    </div>

    <div id="addUserContainer" style="display: none;">
      <h3 class="mb-3">Aggiungi Nuovo Utente</h3>
      <form action="admin.php" method="post" class="row g-3">
        <input type="hidden" name="action" value="add_user">
        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="col-md-6">
          <label for="Ruolo" class="form-label">Ruolo</label>
          <select id="ruolo" name="ruolo" class="form-select" required>
            <option value="">-- Seleziona Ruolo --</option>
            <option value="admin">Admin</option>
            <option value="user">user</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-lg login-button">Aggiungi Utente</button>
        </div>
      </form>
    </div>
  </div>
</main>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var btn = document.getElementById("toggleAddUser");
    var container = document.getElementById("addUserContainer");
    if (btn && container) {
      btn.addEventListener("click", function() {
        if (container.style.display === "none") {
          container.style.display = "block";
          btn.textContent = "Nascondi form";
        } else {
          container.style.display = "none";
          btn.textContent = "Aggiungi Nuovo Utente";
        }
      });
    }
  });
</script>';

$template = file_get_contents("inc/admin_template.inc.php");

$template = str_replace("{{title}}", $title, $template);
$template = str_replace("{{sidebar}}", $sidebar, $template);
$template = str_replace("{{body}}", $body, $template);

echo $template;
