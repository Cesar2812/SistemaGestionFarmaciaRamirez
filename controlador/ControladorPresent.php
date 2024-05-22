<?php
include '../modelo/modeloPresent.php';
$presentacion = new Presentacion();


//funcion para crear Presentacion
if ($_POST['funcion'] == 'crear_presentacion') {
    $descripcion = $_POST['nombre_present'];

    $presentacion->crear_presentacion($descripcion);
}


//funcion para buscar Presentacion
if ($_POST['funcion'] == 'buscarPresentacion') {
    $presentacion->buscar();
    $json = array();
    foreach ($presentacion->objetos as $objeto) {
        $json[] = array(
            'id_Presentacion' => $objeto->id_presentacion,
            'descripcion' => $objeto->descripcion
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}