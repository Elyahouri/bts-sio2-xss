<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Model\CommentModel;
use Dotenv\Dotenv;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$commentModel = new CommentModel();

$commentModel->truncate();
header("Location: index.php");