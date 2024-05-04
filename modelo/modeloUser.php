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


    //funcion para obtener datos y ponerlos en los card
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

    //funcion para editar usuario
    function editar($idUser, $user, $telefono, $residencia, $correo){

        try{
            $sql = "UPDATE usuario SET usuario=:user, Telefono=:telefono, Residencia=:residencia, Correo=:correo WHERE id_Usuario=:idUser";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':idUser' =>$idUser,':user'=>$user,':telefono'=>$telefono,':residencia'=>$residencia,':correo'=>$correo));

        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }

    }


    //metodo para cambiar contraseña
    function cambiar_Contra($idUser,$oldpass,$newpass)
    {

        try {
            $sql = "select * FROM usuario where id_Usuario=:idUser and pass=:oldpass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':idUser' => $idUser, ':oldpass' => $oldpass));
            $this->objetos=$query->fetchAll();

            //validacion si el objeto esta vacio no se encontro la contraseña que se esta poniendo 
            if(!empty($this->objetos)){
                $sql = "update usuario set pass=:newpass where id_Usuario=:idUser";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':idUser'=>$idUser,':newpass'=>$newpass));
                echo 'Cambio Realizado con Exito';
            }else{
                echo 'No se Hicieron Cambios';
            }
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }

    }























}















    




