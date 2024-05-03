<?php
include_once '../modelo/modeloUser.php';

$usuario = new Usuario();

if ($_POST['funcion'] == 'buscar_Usuario') {
    $json = array();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        //creando un json para obtner los datos de la tabla usuario para que sean cargadas en el formulario 
        $json[] = array(
            'nombre' => $objeto->nombre,
            'apellido' => $objeto->apellido,
            'usuario' => $objeto->usuario,
            'edad' => $objeto->edad,
            'rol' => $objeto->descripcion,
            'telefono' => $objeto->telefono,
            'residencia' => $objeto->residencia,
            'correo' => $objeto->correo
            //esto toma datos desde la base de datos
        );
    }
    $jsonString = json_encode($json[0]);
    echo $jsonString;
}