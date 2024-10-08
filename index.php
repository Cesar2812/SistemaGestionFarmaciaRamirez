<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
//se inicia la conexion
session_start();
//en este condicinal se valida si el campo  usuario con determinado rol esta vacio lo que hace es retornar al controlador y mantenerse sentro del login
if (!empty($_SESSION['rol'])) {
    header('Location: controlador/ControladorLogin.php');

} else {
    //en este caso si no ocurre lo anterior se muestra el formulario de inicio de sesion
    session_destroy();
    ?>
    <!--<img class="wave" src="../img/wave.png" alt="">!-->
    <div class=contenedor>
        <div class="img">
            <img src="img/Logo Farmacia Ramirez.png" alt="">
        </div>
        <div class="contenidologin">
            <form action="controlador/ControladorLogin.php" method="POST">
                <img src="img/Farmaceutico.png">
                <h2>Inicio de Sesion</h2>
                <div class="input-div Usuario">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input type="text" name="user" class="input">
                    </div>
                </div>

                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" name="pass" class="input">
                    </div>
                </div>
                <p class="mt-3 mb-1">
                    <a href="vista/RecuperarContra.php">¡CLICK AQUI PARA RECUPERAR CONTRASEÑA!</a>
                </p>

                <input type="submit" class="btn" value="Iniciar Sesion">
            </form>
        </div>
    </div>

    <body>
        <script>
            // 
            function handleLoginError(errorMessage) {
                Swal.fire({
                    position: "center",
                    title: 'Error de Inicio de Sesión',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            }

           

            // 
            document.querySelector('form').addEventListener('submit', function (event) {
                event.preventDefault();


                const username = document.querySelector('input[name="user"]').value;
                const password = document.querySelector('input[name="pass"]').value;

                if (username === '' || password === '') {
                    handleLoginError('Por favor, llene todos los campos.');

                    return;
                }
                this.submit();
            });
        </script>
    </body>
    <script src="js/login.js"></script>

    </html>

    <?php
}
?>