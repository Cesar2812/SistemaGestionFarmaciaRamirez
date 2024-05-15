<?php
include '../modelo/modeloLab.php';
$laboratorio = new Laboratorio();

//funcion para crear Laboratorio
if ($_POST['funcion'] == 'crear_laboratorio') {
    $nombre_lab = $_POST['nombre_lab'];
    $telefono_lab = $_POST['telefono_lab'];
    $logo = 'PorDefecto.jpg';

    $laboratorio->crear_lab($nombre_lab, $telefono_lab, $logo);
}

//funcion para buscar laboratorio
if ($_POST['funcion'] == 'buscarLaboratorio') {
    $laboratorio->buscar();
    $json = array();
    foreach ($laboratorio->objetos as $objeto) {
        $json[] = array(
            'id_Laboratorio' => $objeto->id_laboratorio,
            'nombre' => $objeto->nombre,
            'telefono' => $objeto->telefono,
            'logo' => '../img/' . $objeto->logo
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}

//funcion para cambiar avatar
if ($_POST['funcion'] == 'cambiar_logo') {
    $id = $_POST['id_logo_lab'];

    if (($_FILES['foto']['type'] == 'image/jpeg') || ($_FILES['foto']['type'] == 'image/png') || ($_FILES['foto']['type'] == 'image/gif')) {
        $nombre = uniqid() . '-' . $_FILES['foto']['name'];
        $ruta = '../img/' . $nombre;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
        $laboratorio->cambiar_logo($id, $nombre);

        foreach ($laboratorio->objetos as $objeto) {
            if($objeto->logo!='PorDefecto.jpg'){
                unlink('../img/' . $objeto->logo);
            }
            
        }
        //devolviendo imagen en un json para actualizarlas en el formulario

        $json = array();
        $json[] = array(
            'ruta' => $ruta,
            'alert' => 'edit'
        );

        $jsonString = json_encode($json[0]);
        echo $jsonString;
    } else {
        $json = array();
        $json[] = array(
            'alert' => 'noedit'
        );

        $jsonString = json_encode($json[0]);
        echo $jsonString;
    }


}
