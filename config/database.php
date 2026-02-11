<?php

$host = "localhost";
$dbname = "progetto_bucigno";
$user = "root";
$pass = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connessione riuscita!";
} catch (PDOException $e) {
    die("Errore di connessione: " . $e->getMessage());
}
