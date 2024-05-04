<?php
include_once '../modelo/modeloUser.php';

$usuario = new Usuario();

//este metodo busca los datos en la base de datos para tomarlos como un JSON y mandarlos a los card del fromulario
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

//este metodo toma los datos de las card del formulario y los manda los input para que sean editados
if ($_POST['funcion'] == 'capturar_datos') {
    $json = array();
    $idUser = $_POST['id_Usuario'];
    $usuario->obtener_datos($idUser);
    foreach ($usuario->objetos as $objeto) {
        //creando un json para obtner los datos de la tabla usuario para que sean cargadas en el formulario 
        $json[] = array(
            'usuario' => $objeto->usuario,
            'telefono' => $objeto->telefono,
            'residencia' => $objeto->residencia,
            'correo' => $objeto->correo
            //esto toma datos desde la base de datos
        );
    }
    $jsonString = json_encode($json[0]);
    echo $jsonString;
}


//este metodo toma los datos cargados en los inputs ya una vez editados para mandarlos a la data
if ($_POST['funcion'] == 'editar_usuario') {
    $idUser = $_POST['id_Usuario'];
    $user=$_POST['admin'];
    $telefono = $_POST['tele'];
    $residencia = $_POST['residenci'];
    $correo = $_POST['email'];

    $usuario->editar($idUser,$user,$telefono,$residencia,$correo);

    echo 'Editado';



}