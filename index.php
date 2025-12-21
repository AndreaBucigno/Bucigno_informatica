<?php
$title = "WHISTLEBLOWING";
$button = '<a href="login.php" class="text-white me-3">
    <i class="bi bi-person-circle" style="font-size: 1.9rem;"></i>
</a>';

$modal_report = file_get_contents('modal/modal_segnalazione.html');

$body = '
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
';

$body .= $modal_report;

$template = file_get_contents("inc/template.inc.php");
$template = str_replace("{{title}}", $title, $template);
$template = str_replace("{{body}}", $body, $template);
$template = str_replace("{{button}}", $button, $template);
echo ($template);
