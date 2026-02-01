<?php
require_once __DIR__ . '/HandlerMail.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email) {
        $mail = getMailerInstance();

        if ($mail) {
            try {
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Recupero Password - Test';

                $mail->Body = "<p>Ciao,</p><p>Questo è un test per il recupero password.</p>";
                $mail->send();
                $message_type = 'success';
            } catch (\Exception $e) {
                $message = 'Errore durante l\'invio della mail: ' . $e->getMessage();
                $message_type = 'danger';
            }
        } else {
            $message = 'Server di posta non configurato.';
            $message_type = 'danger';
        }
    } else {
        $message = 'Per favore inserisci un indirizzo email valido.';
        $message_type = 'danger';
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINA WEB - Recupera Password</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <!--bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!--Font Awesome for icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body class="login-body">
    <div class="container">
        <section class="login-section vh-100 d-flex align-items-center justify-content-center">
            <div class="login-container">
                <a href="index.php" class="btn btn-outline-light btn-sm position-absolute top-0 end-0 m-3" aria-label="Torna alla home">
                    <i class="bi bi-house-fill me-1"></i>Home
                </a>
                <div class="row g-0 h-100 align-items-center justify-content-center">
                    <div class="col-12 d-flex align-items-center justify-content-center login-right-section">
                        <div class="login-form-wrapper">

                            <div class="text-center mb-3">
                                <h1 class="login-title"><i class="fas fa-envelope-open-text me-2"></i>Recupera Password</h1>
                                <p class="text-white-50">Riceverai una mail con le istruzioni per reimpostare la password</p>
                            </div>

                            <?php if (!empty($message)) : ?>
                                <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                                    <?php echo htmlspecialchars($message); ?>
                                </div>
                            <?php endif; ?>

                            <form class="login-form" method="post" action="" role="form" aria-label="Recupera password">
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold mb-2" for="email">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </label>
                                    <input type="email" id="email" name="email" class="form-control form-control-lg login-input"
                                        placeholder="Inserisci la tua email" required autocomplete="email" />
                                </div>

                                <div class="d-grid gap-2 mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg login-button">
                                        <i class="fas fa-paper-plane me-2"></i>Invia
                                    </button>
                                </div>

                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="login.php" class="btn btn-outline-light ">Torna al login</a>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>