<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\Entity\User;
use App\Model\userModel;
use Dotenv\Dotenv;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();
$errors = [];
$success = true;

$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];

if ($email === "") {
    $errors["email"] = "Empty email";
}


if (count(array_keys($errors)) === 0) {
    $user = new User(null, $email, $name, $password);
    $userModel = new UserModel();
    $userModel->create($user);
} else {
    $success = false;
}


echo json_encode(["success" => $success, "errors" => $errors]);
