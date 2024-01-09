<?php

namespace utilidades;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable("./../");
$dotenv->safeLoad();
class DB
{
    private \mysqli $con;
    public function __construct()
    {
        $user = $_ENV['USER_'];
        $password = $_ENV['PASSWORD'];
        $database = $_ENV['DATABASE'];
        $host = $_ENV['HOST'];
        $port = $_ENV['PORT_MYSQL'];

        var_dump($port);
        try {
            $this->con = new \mysqli($host, $user, $password, $database, $port);

        }catch (\mysqli_sql_exception $error){
            die("Error conectando".$error->getMessage());
        }
    }


    public function insertar_datos($user, $password):bool {

        $password = password_hash($password, PASSWORD_BCRYPT);

        $sentencia =<<<FIN
            insert into usuarios (nombre, password)
            values (?, ?)
        FIN;

        try {
            $stmt = $this->con->stmt_init();
            $stmt->prepare($sentencia);
            $stmt->bind_param("ss", $user, $password);
            $stmt->execute();
            $stmt->store_result();

            $rtdo= $this->con->query($sentencia);

        }catch (\mysqli_sql_exception $e){
            return false;
        }

        return $rtdo;
    }


    public function validar_usuario( $user, $password):bool {
        $sentencia =<<<FIN
            select password from usuarios
            where nombre = ? 
        FIN;

        try {
            $stmt = $this->con->stmt_init();
            $stmt->prepare($sentencia);
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $stmt->store_result();

            $stmt->bind_result($pass_database);
            $stmt->fetch();
            return password_verify($password, $pass_database);

            $rtdo = $this->con->query($sentencia);
        }catch (\mysqli_sql_exception $e){
            return false;
        }

        if ($rtdo->num_rows>0){return true;}else{return false;}
    }

    public function obtener_familias() {
        $sentencia = "select * from familia";

        $rtdo = $this->con->query($sentencia);

        while ($fila=$rtdo->fetch_row())

        return $rtdo->fetch_all();

    }
}