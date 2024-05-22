<?php
include 'Conexion.php';//incluyendo a la conexion a la base de datos con php

class Presentacion{
    var $objetos;
    private $acceso;

    //se crea el metodo constructor para cuando se instancie la clase laboratorio llame a la conexion PDO
    public function __construct()
    {
        try {
            $dbConexion = new Conexion();
            $this->acceso = $dbConexion->pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    function crear_presentacion($descripcion){
        try {
            //corroborandi si existe una presentacion con el mismo nombre
            $sql = "select p.id_Presentacion  from presentacion p where p.descripcion=:descripcion";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':descripcion' => $descripcion));
            $this->objetos = $query->fetchAll();

            //validacion de que el nombre no sea igual
            if (!empty($this->objetos)) {
                echo 'No agregado';

            } else {
                $sql = "insert into presentacion(descripcion)
                       VALUES(:descripcion)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':descripcion' => $descripcion));
                echo 'agregado';

            }

        } catch (PDOException $ed) {
            die("Error al ejecutar la consulta: " . $ed->getMessage());
        }

    }

    function buscar(){
        try {
            if (!empty($_POST['consulta'])) {
                $consulta = $_POST['consulta'];
                $sql = "SELECT * FROM presentacion p
                      WHERE p.descripcion like :consulta";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta' => "%$consulta%"));
                $this->objetos = $query->fetchAll();
                return $this->objetos;
            } else {
                $sql = "SELECT * FROM presentacion p
                    WHERE p.descripcion != '' ORDER BY p.id_Presentacion limit 7";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos = $query->fetchAll();
                return $this->objetos;
            }
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());

        }

    }

    //funcion para editar presentacion
    function editar($id, $descripcion)
    {
        try {
            $sql = "update presentacion p set p.descripcion=:descripcion where p.id_Presentacion=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id, ':descripcion' => $descripcion));
            echo 'edit';
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }


    //funcion para eliminar una presentacion 
    function eliminar($id)
    {
        try {
            $sql = "DELETE FROM presentacion WHERE id_Presentacion=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
            if (!empty($query->execute(array(':id' => $id)))) {
                echo 'borrado';
            } else {
                echo 'noBorrado';
            }

        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());

        }

    }
}