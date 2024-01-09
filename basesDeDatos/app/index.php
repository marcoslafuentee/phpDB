<?php

require "vendor/autoload.php";
use utilidades\DB;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable("./../");
$dotenv->safeLoad();

$opcion = $_POST['submit'] ??"";

$db = new DB();
var_dump($db);


switch ($opcion){
    case "Acceder":
        $user = $_POST['user'];
        $password = $_POST['password'];
        if ($db->validar_usuario($user, $password)){
            session_start();
            $_SESSION['user']=$user;
            header("Location:sitio.php");
            exit();
        }
        $msj ="Datos incorrectos";
        break;
    case "Registrarme":
        $user = $_POST['user'];
        $password = $_POST['password'];
        $rtdo = $db->insertar_datos($user, $password);
        $msj = $rtdo? "Se ha insertado $user": "Error insertando $user";
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

    <title>BD</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<h1><?=$msj ??""?></h1>
<fieldset>
    <legend>Datos de acceso</legend>
    <form action="" method="POST">
        Usuario <input type="text" name="user" placeholder="Usuario" id=""><br />
        Passowrd <input type="text" name="password" placeholder="Password" id=""><br />
        <input type="submit" value="Acceder" name="submit">
        <input type="submit" value="Registrarme" name="submit">
    </form>
</fieldset>

</body>
</html>