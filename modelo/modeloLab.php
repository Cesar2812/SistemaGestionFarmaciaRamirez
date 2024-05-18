<?php
include 'Conexion.php';//incluyendo a la conexion a la base de datos con php



//creando la clase laboratorio 
class Laboratorio
{
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

    //metodo para crear Laboratorio
    function crear_lab($nombre_lab, $telefono_lab, $logo)
    {
        try {
            //corroborandi si existe un laboratorio con el mismo nombre
            $sql = "select id_Laboratorio from laboratorio where nombre=:nombre_lab";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre_lab' => $nombre_lab));
            $this->objetos = $query->fetchAll();

            //validacion de que el nombre no sea igual
            if (!empty($this->objetos)) {
                echo 'No agregado';

            } else {
                $sql = "insert into laboratorio(nombre,telefono,logo)
                    values(:nombre_lab,:telefono_lab,:logo)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':nombre_lab' => $nombre_lab, ':telefono_lab' => $telefono_lab, ':logo' => $logo));
                echo 'agregado';

            }

        } catch (PDOException $ed) {
            die("Error al ejecutar la consulta: " . $ed->getMessage());
        }
    }

    //funcion para buscar laboratorio
    function buscar()
    {
        try {
            if (!empty($_POST['consulta'])) {
                $consulta = $_POST['consulta'];
                $sql = "SELECT * FROM laboratorio l
                      WHERE l.nombre like :consulta";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta' => "%$consulta%"));
                $this->objetos = $query->fetchAll();
                return $this->objetos;
            } else {
                $sql = "SELECT * FROM laboratorio l
                    WHERE l.nombre != '' ORDER BY l.id_Laboratorio limit 7";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos = $query->fetchAll();
                return $this->objetos;
            }
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());

        }

    }

    //funcion para cambiar logo
    function cambiar_logo($id, $nombre)
    {
        try {
            $sql = "select logo from laboratorio where id_Laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
            $this->objetos = $query->fetchAll();


            $sql = "update laboratorio set logo=:nombre where id_Laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id, ':nombre' => $nombre));
            return $this->objetos;


        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }

    }

    //metodo para editar laboratorio
    function editar($id, $nombre, $telefono)
    {
        try {
            $sql = "UPDATE laboratorio SET nombre=:nombre, telefono=:telefono WHERE id_Laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id, ':nombre' => $nombre, ':telefono' => $telefono));
            echo 'edit';
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }



    function eliminar($id)
    {   
        try{
            $sql = "DELETE FROM laboratorio WHERE id_Laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
            if(!empty($query->execute(array(':id' => $id)))){
                echo 'borrado';
            }else{
                echo 'noBorrado';
            }
           
        }catch(PDOException $e){
            die("Error al ejecutar la consulta: " . $e->getMessage());

        }
    }
}






