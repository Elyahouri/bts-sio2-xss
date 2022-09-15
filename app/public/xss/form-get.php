<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Entity\Comment;
use App\Model\CommentModel;
use Dotenv\Dotenv;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

setcookie('password', 'ilovesecrets');

$keyword = null;
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BTS SIO 2 - Failles XSS - Formulaire GET</title>
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
                <div class="card-header"><b>Mon moteur de recherche</b></div>
                <div class="card-body">
                    <form type="get" action="" id="searchForm" autocomplete="off">
                        <div class="form-group">
                            <label for="keyword">Mot clé</label>
                            <input id="keyword" type="text" name="keyword" class="form-control">
                        </div>
                        <div class="d-grid gap-2">
                            <input class="btn btn-success mt-2" type="submit" name="submit" value="Rechercher">
                        </div>
                    </form>
                    <hr/>
                    <?php if($keyword){echo "Résultat(s) pour le mot-clé : $keyword"; }?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>`
<script src="index.js"></script>
</body>
</html>