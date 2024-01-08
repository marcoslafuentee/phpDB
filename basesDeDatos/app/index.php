<?php

require "vendor/autoload.php";
use utilidades\DB;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable("./../");
$dotenv->safeLoad();

$opcion = $_POST['submit'];

$db = new DB();
var_dump($db);

switch ($opcion){
    case "Acceder":
        $user = $_POST['user'];
        $password = $_POST['password'];
        if ($db->validar_usuario($user, $password)){
            session_start();
            $_SESSION['user'] = $user;
            //header(Location:);
        }

        break;
    case "Registrarme":
        $user = $_POST['user'];
        $password = $_POST['password'];
        $rtdo = $db->insertar_datos($user, $password);
        $msj = $rtdo? "Se ha insertado $user" : "Nop";

        break;
    default:

}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <fieldset>
        <legend>Datos de acceso</legend>
        <form action="" method="post">
            Usuario <input type="text" name="user" placeholder="Usuario" id="">
            Password <input type="text" name="password" placeholder="passsword" id="">
            <input type="submit" value="Acceder" name="submit">
            <input type="submit" value="Registrarme" name="submit">
        </form>
    </fieldset>
</body>
</html>