<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BTS SIO 2 - Failles XSS - Formulaire</title>
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
                <div class="card-header"><b>Formulaire</b></div>
                <form action="action.php" method="post" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Prénom</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input id="age" type="text" name="age" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Adresse Email</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Ville</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="pays" class="form-label">Pays</label>
                            <select class="form-select" id="pays">
                                <option selected disabled value="">Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <input class="btn btn-success mt-2" type="submit" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>