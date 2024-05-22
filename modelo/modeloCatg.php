<?php
include 'Conexion.php';//incluyendo a la conexion a la base de datos con php

class Categoria{
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


    //funcion para crear Categoria
    function crear_categoria($descripcion){
        try {
            //corroborandi si existe una Categoria con el mismo nombre
            $sql = "select c.id_Categoria from categoria c where c.descripcion=:descripcion";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':descripcion'=>$descripcion));
            $this->objetos = $query->fetchAll();

            //validacion de que el nombre no sea igual
            if (!empty($this->objetos)) {
                echo 'No agregado';

            } else {
                $sql = "insert into categoria(descripcion)
                         values(:descripcion)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':descripcion' => $descripcion));
                echo 'agregado';

            }

        } catch (PDOException $ed) {
            die("Error al ejecutar la consulta: " . $ed->getMessage());
        }
    }



    //funcion para buscar Categoria
    function buscar(){
        try {
            if (!empty($_POST['consulta'])) {
                $consulta = $_POST['consulta'];
                $sql = "SELECT * FROM categoria c
                      WHERE c.descripcion like :consulta";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta' => "%$consulta%"));
                $this->objetos = $query->fetchAll();
                return $this->objetos;
            } else {
                $sql = "SELECT * FROM categoria c
                    WHERE c.descripcion != '' ORDER BY c.id_Categoria limit 7";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos = $query->fetchAll();
                return $this->objetos;
            }
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());

        }
    }


    //funcion para editar Catgeoria
    function editar($id, $descripcion){
        try {
            $sql = "update categoria c set c.descripcion=:descripcion where c.id_Categoria=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id, ':descripcion'=>$descripcion));
            echo 'edit';
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

    //funcion para elimnar Catgeoria
    function eliminar($id){
        try {
            $sql = "DELETE FROM categoria WHERE id_Categoria=:id";
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