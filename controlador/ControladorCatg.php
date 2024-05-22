<?php
include '../modelo/modeloCatg.php';
$categoria = new Categoria();


//funcion para crear Categoria
if ($_POST['funcion'] == 'crear_categoria') {
    $descripcion = $_POST['nombre_categ'];

    $categoria->crear_categoria($descripcion);
}


//funcion para buscar categoria
if ($_POST['funcion'] == 'buscarCategoria') {
    $categoria->buscar();
    $json = array();
    foreach ($categoria->objetos as $objeto) {
        $json[] = array(
            'id_Categoria' => $objeto->id_categoria,
            'descripcion' => $objeto->descripcion
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}

