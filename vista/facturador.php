<?php
//ESTE ES EL FROMULARIO PARA EL ROL DE FACTURADOR O VENDEDOR


//iniciando la sesion donde se obtiene el rol del usuario en este caso que sea administrador 
session_start();
if ($_SESSION['rol'] == 2) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>Facturador</title>
    </head>

    <body>
        <h1>Hola Facturador</h1>
        <a href="../controlador/ControladorDeslogueo.php">Cerrar Sesion</a>
    </body>

    </html>
    <?php
} else {
    header('Location:../index.php');
}
?>