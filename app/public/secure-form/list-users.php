<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Entity\User;
use App\Model\UserModel;
use Dotenv\Dotenv;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();


setcookie('password', 'ilovesecrets');

$userModel = new UserModel();
$users = $userModel->fetchAll();


?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BTS SIO 2 - Failles XSS - Formulaire POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row py-4">
        <div class="col mb-2">
            <a class="btn btn-danger" href="../index.php"> Retour </a>
        </div>
        <hr/>
        <div class="col">
            <div class="card">
                <div class="card-header"><b>Users</b></div>
                <div class="card-body">
                    <table class="table table-striped table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Password</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($users as $user) {
                            echo "<tr>";
                            echo "<td>" . $user->getId() . "</td>";
                            echo "<td>" . $user->getName() . "</td>";
                            echo "<td>" . $user->getEmail() . "</td>";
                            echo "<td>" . $user->getPassword() . "</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>`
</body>
</html>
