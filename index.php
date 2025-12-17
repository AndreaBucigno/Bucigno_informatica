<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WISTLEBLOWHING</title>
        <link rel="stylesheet" href="assets/css/index.css">
    <!--bootstrap link -->    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!--Font Awesome for icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  
</head>
<body>
<nav class="navbar fixed-top bg-dark">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    
    <!-- Logo -->
    <img src="assets/images/Logo.png" alt="Logo" class="Logo">
    

    <!-- Sezione pulsanti a destra -->
    <div class="d-flex align-items-center">

      <a href="login.php" class="text-white me-3">
        <i class="bi bi-person-circle" style="font-size: 1.9rem;"></i>
      </a>
    </div>

  </div>
</nav>

<div class="container">
    
    <section class="hero-wblw">
    <div class="hero-wblw-content">
        
        <h1 class="hero-wblw-title">Sistema di Segnalazione</h1>

        <p class="hero-wblw-desc">
            Invia segnalazioni in modo sicuro, protetto e conforme alle normative.
        </p>

        <a class="btn-wblw" data-bs-toggle="modal" data-bs-target="#modalSegnalazione">
            Invia Segnalazione
        </a>
        
        <div id="modalContainer"></div>

    </div>
</section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="assets/js/script.js"></script>
</body>

</html>