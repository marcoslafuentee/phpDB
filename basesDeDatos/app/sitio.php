<?php
session_start();
$user = $_SESSION['user'] ?? null;
if (is_null($user)) {
    header("Location:index.php");
    exit();
}

require "vendor/autoload.php";
use utilidades\DB;
use Dotenv\Dotenv;
$env = Dotenv::createImmutable("./../");

$db = new DB();

$familias = $db->obtener_familias();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Bienvenido <?=$user?></h1>

<form method="post" action="sitio.php" name="seleccion">
    <input type="checkbox">
</form>

</body>
</html>