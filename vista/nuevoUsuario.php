<?php
//ESTE ES EL FORMULARIO PARA INGRESAR USUARIOS AL SISTEMA

//metodo para iniciar la sesion
session_start();
//con este condicional se toma el rol del usuario que se ha logueado 
if ($_SESSION['rol'] === 1 || $_SESSION['rol'] === 3) {
    //incluyendo el archivo header del Layout para usarse en todos los formularios de forma global
    include_once 'layouts/header.php';
    ?>
    <title>Registro De Usuarios</title>
    <?php
    include_once 'layouts/navs.php';
    ?>


    <!--Modal Para poner la contraseña y ascender Roles a Facturadores-->
    <div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Confirmacion De Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="foto-contraseña" src="../img/user.png" class="profile-user-img img-fluid img-circle">
                    </div>

                    <div class="text-center">
                        <b>
                            <?php
                                echo $_SESSION['nombre'];
                                ?>
                        </b>
                    </div>
                    <span>
                        Se Necesita Su Contraseña Para Confirmar
                    </span>

                    <div class="alert alert-danger text-center" id="noEliminado" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>La Contraseña No es Correcta</span>
                    </div>

                    <form id="form-confirmar">



                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-unlock-alt"></i>
                                </span>
                            </div>
                            <input id="old-pass" type="password" class="form-control"
                                placeholder="Ingrese Contraseña Actual">

                                <input type="hidden" id="id_user">
                                <input type="hidden" id="funcion">
                        </div>

                        

                        <div class="modal-footer">
                                <button type="button" class=" btn btn-danger" data-dismiss="modal">
                                Cerrar
                            </button>
                            <!--<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>-->
                            <button type="submit" class="btn bg-gradient-primary">Aceptar</button>
                        </div>
    

                    </form>
                </div>

            </div>
            </div>
    </div>



    <!-- Modal para Insertar un nuevo Usuario-->
    <div class="modal fade" id="crearUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="card card-light">
                    <div class="card-header">
                        <h2 class="card-title">Crear Usuario</h2>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger text-center" id="noAgregado" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>No Se Permite Ingresar con el Mismo Nombre De Usuario</span>
                        </div>

                        <form id="crearUser">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-control" placeholder="Ingrese El Nombre"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input id="apellido" type="text" class="form-control" placeholder="Ingrese El Apellido"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="fecha">Fecha De Nacimiento</label>
                                <input id="edad" type="date" class="form-control" placeholder="Ingrese Fecha De Nacimiento"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="user">Nombre De Usuario</label>
                                <input id="user" type="text" class="form-control" placeholder="Ingrese El Nombre De Usuario"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="pass">Contraseña</label>
                                <input id="pass" type="password" class="form-control" placeholder="Contraseña" required>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-primary float-right m-1">
                                    Guardar
                                </button>

                                <button type="button" class=" btn btn-danger float-right m-1"
                                    data-dismiss="modal">
                                    Cerrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Contenido de la Pagina -->
    <div class="content-wrapper">

        <!-- Contenido de la parte de Arriba en la parte de arriba -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>GESTION DE USUARIOS <button id="button-Crear" type="button" data-toggle="modal"
                                data-target="#crearUsuario" class="btn bg-gradient-primary ml-2">Crear Nuevo
                                Usuario</button></h1>
                        <input type="hidden" id="user_tipo" value="<?php echo $_SESSION['rol'] ?>">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vista/administrador.php">Volver a Inicio</a></li>
                            <li class="breadcrumb-item active">Gestion De Usuario</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!--Buscador-->
        <section>
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Usuario</h3>
                        <div class="input-group">
                            <input type="text" id="buscarUser" class="form-control float-left"
                                placeholder="Ingrese El Nombre Del Usuario">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="fas fa-search"></i></button></div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="card-usuarios" class="row d-flex-aling-items-stretch">
                        </div>

                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

        </section>
    </div>
    </div>

    <?php
    include_once 'layouts/funciones.php';
} else {
    header('Location:../index.php');
}
?>

<script src="../js/GestionUsuario.js"></script>