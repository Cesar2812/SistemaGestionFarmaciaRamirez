<?php
include_once '../modelo/modeloUser.php';
session_start();

//obtenemos con el metodo post ose el envio desde los input del formulario index y se asignan a las variables 
$user = $_POST["user"];
$pass = $_POST["pass"];

//se crea un objeto de la clase Usuario que esta en modelo
$usuario = new Usuario();

//condiconal que funciona con respecto a los accesos del sistema 
if (!empty($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header('Location: ../vista/administrador.php');
            break;

        case 2:
            header('Location: ../vista/facturador.php');
            break;

    }
} else {
    //si no se cumple lo anterior quiere decir que el usuario y la contraseña fueron correctas y accede a la pagina correspodiente en base al rol del usuario que se haya logueado 
    //pasando los atributos al metodo loguarse los cuales son las variables que se obtienen del formulario con el metodo post

    //invocacion del metodo loguearse y se pasn los campos obtenidos en las variables anteriores que vienen de los input del formulario index 
    $usuario->loguarse($user, $pass);
    //validacion para el acceso a los diferentes permisos del sistema 
    if (!empty($usuario->objetos)) {
        foreach ($usuario->objetos as $objeto) {

            $_SESSION['usuario'] = $objeto->id_usuario;
            $_SESSION['rol'] = $objeto->id_rol;
            $_SESSION['nombre'] = $objeto->nombre;
            $_SESSION['apellido'] = $objeto->apellido;
            
        }

        //validando en base al rol que tenga el usuario para activar las diferentes vistas del sistema 
        switch ($_SESSION['rol']) {
            case 1:
                header('Location: ../vista/administrador.php');
                break;

            case 2:
                header('Location: ../vista/facturador.php');
                break;

        }
    } else {
        //si no se cumple la condicion se regresa al index osea al loguin 
        header('Location:../index.php');

    }

}
