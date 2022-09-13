<?php
require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();


if (isset($_POST['submit'])) {
//    header("Location: ../secure-form/index.php");
}