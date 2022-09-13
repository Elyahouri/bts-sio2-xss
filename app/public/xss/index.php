<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Entity\Comment;
use App\Model\CommentModel;
use Dotenv\Dotenv;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

//$date = new DateTime('+1 day');
//setcookie('password', 'ilovesecrets', $date->getTimestamp(), "","",false,true);
setcookie('password', 'ilovesecrets');

$commentModel = new CommentModel();
$comments = $commentModel->fetchAll();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $body = $_POST['body'];
    //$body =  htmlspecialchars($_POST['body'], ENT_QUOTES);
    $newComment = new Comment(null, $name, $body);
    $commentModel->create($newComment);
    header("Location: ../xss/index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row py-4">
        <div class="col mb-2">
            <a class="btn btn-danger" href="../index.php"> Back </a>
        </div>
        <hr/>
        <div class="col">
            <div class="card">
                <div class="card-header">Make Your Comment</div>
                <div class="card-body">
                    <form action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <input class="btn btn-success mt-2" type="submit" name="submit">
                    </form>
                    <hr/>
                    <div class="card">
                        <div class="card-header">Comments</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Body</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($comments as $comment) {
                                            echo "<tr>";
                                            echo "<td>" . $comment->getName() . "</td>";
                                            echo "<td>" . $comment->getBody() . "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>