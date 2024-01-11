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

$opcion = $_POST['submit'] ??"";

var_dump($_POST);
 switch ($opcion){
     case "Mostrar productos":
         $cod_familia = $_POST['familia'];
         $productos = $db->obtener_producto($cod_familia);
         var_dump($productos);
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
</head>
<body>
<h1>Bienvenido <?=$user?></h1>

<form method="post" action="sitio.php" name="seleccion">
    <select name="familia" id="">
        <?php
            foreach ($familias as $familia){
                $cod = $familia[0];
                $nombre =$familia[1];
                $checked= "";
                if ($cod == $cod_familia){
                    $checked="selected";
                }

                echo "<option $checked value='$cod'>$nombre</option>";
            }

        ?>
    </select>
    <input type="submit" name="submit" value="Mostrar productos">
</form>
<?php if (isset($productos)): ?>
<table>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
    </tr>
    <?php
        foreach ($productos as $producto){
            echo <<<FIN
                <tr>
                <td>{$producto['nombre']}</td>
                <td>{$producto['PVP']}</td>
                <td><form action="producto.php">
                    <input type="submit" value="Editar" name="submit">
                    <input type="hidden" name="familia" value="{$producto['cod']}">
                    <input type="hidden" name="familia" value="$cod_familia">
                </form></td>
                </tr>
FIN;
        }
    ?>
</table>
<?php endif ?>

</body>
</html>