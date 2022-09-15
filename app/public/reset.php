<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Model\CommentModel;
use App\Model\userModel;
use Dotenv\Dotenv;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$commentModel = new CommentModel();
$userModel = new UserModel();
$commentModel->truncate();
$userModel->truncate();
header("Location: index.php");