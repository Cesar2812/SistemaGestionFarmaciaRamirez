<?php
include_once '../modelo/modeloUser.php';

$usuario = new Usuario();
session_start();
$id_usuario = $_SESSION['usuario'];

//este metodo busca los datos en la base de datos para tomarlos como un JSON y mandarlos a los card del fromulario
if ($_POST['funcion'] == 'buscar_Usuario') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        //obteniendo la fecha de la base de datos osea la fecha de nacimiento del usuario 
        //convierte la edad en un objeto de tiempo 
        $nacimiento = new DateTime($objeto->edad);
        //compara la fecha actual con la fecha de nacimiento y hace una pequeña resta 
        $edad = $nacimiento->diff($fecha_actual);
        $edad_year = $edad->y;
        //creando un json para obtner los datos de la tabla usuario para que sean cargadas en el formulario 
        $json[] = array(
            'nombre' => $objeto->nombre,
            'apellido' => $objeto->apellido,
            'usuario' => $objeto->usuario,
            'edad' => $edad_year,
            'rol' => $objeto->descripcion,
            'telefono' => $objeto->telefono,
            'residencia' => $objeto->residencia,
            'correo' => $objeto->correo,
            'foto' => '../img/' . $objeto->foto
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
    $user = $_POST['admin'];
    $telefono = $_POST['tele'];
    $residencia = $_POST['residenci'];
    $correo = $_POST['email'];

    $usuario->editar($idUser, $user, $telefono, $residencia, $correo);

    echo 'Editado';
}

//funcion para cambiar contraseña
if ($_POST['funcion'] == 'cambiar_contraseña') {
    $idUser = $_POST['id_Usuario'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];

    $usuario->cambiar_Contra($idUser, $oldpass, $newpass);
}


//funcion para cambiar foto de perfil
if ($_POST['funcion'] == 'cambiarfoto') {
    if (($_FILES['foto']['type'] == 'image/jpeg') || ($_FILES['foto']['type'] == 'image/png') || ($_FILES['foto']['type'] == 'image/gif')) {
        $nombre = uniqid() . '-' . $_FILES['foto']['name'];
        $ruta = '../img/' . $nombre;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
        $usuario->cambiar_foto($id_usuario, $nombre);

        foreach ($usuario->objetos as $objeto) {
            unlink('../img/' . $objeto->foto);
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



//buscar Usuario 
if ($_POST['funcion'] == 'buscar_user_adm') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->buscar();
    foreach ($usuario->objetos as $objeto) {
        //obteniendo la fecha de la base de datos osea la fecha de nacimiento del usuario 
        //convierte la edad en un objeto de tiempo 
        $nacimiento = new DateTime($objeto->edad);
        //compara la fecha actual con la fecha de nacimiento y hace una pequeña resta 
        $edad = $nacimiento->diff($fecha_actual);
        $edad_year = $edad->y;
        //creando un json para obtner los datos de la tabla usuario para que sean cargadas en el formulario 
        $json[] = array(
            'id' => $objeto->id_usuario,
            'nombre' => $objeto->nombre,
            'apellido' => $objeto->apellido,
            'usuario' => $objeto->usuario,
            'edad' => $edad_year,
            'rol' => $objeto->descripcion,
            'telefono' => $objeto->telefono,
            'residencia' => $objeto->residencia,
            'correo' => $objeto->correo,
            'foto' => '../img/' . $objeto->foto,
            'tipo_usuario' => $objeto->id_rol
            //esto toma datos desde la base de datos
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}

//evento para crear usuario
if ($_POST['funcion'] == 'crear_usuario') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $pass = $_POST['contraseña'];
    $tipo = 2;
    $foto = 'user.png';

    $usuario->crear_usuario($nombre, $apellido, $edad, $nombre_usuario, $pass, $tipo, $foto);
}



//evento para ascender de rol al usuario
if ($_POST['funcion'] == 'ascender') {
    $pass=$_POST['pass'];
    $id_ascendido = $_POST['id_usuario'];
    //creando el metodo ascender usuario
    $usuario->ascender($pass,$id_ascendido, $id_usuario);
}




