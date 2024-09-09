<?php
class Conexion
{
    //declaracion de las variables para usarlas en la cadena de conexion a la base de datos Mysql  
    private $hosting = "localhost";//servidor local
    private $nameBD = "bdfarmaciaramirez";// nombre de la base de datos

    private $usuario = "root";// usuario
    private $pass = "root123";// contraseña
    private $charset = "utf8";
    public $pdo = null;

    //atributos de la clase PDO para una conexion mas segura   
    private $atributos = [PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

    //metodo constructor donde se instacia la conexion a la base de datos 
    public function __construct()
    {
        try {

            //cadena de conexion a la base de datos asignandole la cadena a la varible pdo que se inicializa en NULL
            $this->pdo = new PDO('mysql:host=' . $this->hosting . ';dbname=' . $this->nameBD . ';charset=' . $this->charset, $this->usuario, $this->pass, $this->atributos);

        } catch (PDOException $ex) {
            echo 'ERROR:' . $ex->getMessage();
            exit;
        }
    }
}

