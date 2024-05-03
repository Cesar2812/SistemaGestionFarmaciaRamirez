<?php

//incluyendo el archivo de conexion al archivo de modelo de Usuario
include_once 'Conexion.php';

//creacion de la clase Usuario
class Usuario
{
    var $objetos;//creacion de variables para usarser en el metodo constructor
    private $acceso;

    //construtor de la clase Uusario donde se instacia la conexion y se crea una varible pdo para asignar la cadena

    //funcion que contiene la clase de la conexion y se almacena en la variable acceso la cadena de la variable pdo del archivo conexion 
    public function __construct()
    {
        try {
            $dbConexion = new Conexion();
            $this->acceso = $dbConexion->pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    //metodo loguearse el cual recibe parametros que vienen del controlador de la respectiva clase para ejecutar la consulta sql 
    function loguarse($usuario, $pass)
    {
        try {
            $sql = "SELECT * FROM usuario INNER JOIN rol ON usuario.id_Usuario = rol.id_Rol WHERE usuario=:usuario AND pass =:pass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':usuario' => $usuario, ':pass' => $pass));
            //escribe los campos y datos de la tabla usuario del usuario logueado 
            $this->objetos = $query->fetchAll();
            return $this->objetos;

        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }
    function obtener_datos($id)
    {
        try { 
            $sql = "select * from usuario inner join rol on usuario.id_Usuario=rol.id_Rol and id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            //escribe los campos y datos de la tabla usuario del usuario logueado 
            $this->objetos = $query->fetchAll();
            return $this->objetos;

        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

}