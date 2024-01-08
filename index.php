<?php

$host = "localhost";
$user = "alumno";
$password = "password_alumno";
$database = "dwes";
$port = 23306;

try {
    $con = new mysqli($host, $user, $password, $database, $port);
}catch (mysqli_sql_exception $e){
    die("Error conectando");
}
var_dump($con);
