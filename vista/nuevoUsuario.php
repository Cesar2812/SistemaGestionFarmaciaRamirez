<?php


//ESTE ES EL FORMULARIO PARA INGRESAR USUARIOS AL SISTEMA

//metodo para iniciar la sesion
session_start();
//con este condicional se toma el rol del usuario que se ha logueado 
if ($_SESSION['rol'] == 1) {
    //incluyendo el archivo header del Layout para usarse en todos los formularios de forma global
    include_once 'layouts/header.php';
    ?>
    <title>Registro De Usuarios</title>
    <?php
    include_once 'layouts/navs.php';
    ?>

    <!-- Modal para Insertar un nuevo Usuario-->
    <div class="modal fade" id="crearUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="card card-info">
                    <div class="card-header">
                        <h2 class="card-title">Crear Usuario</h2>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form id="crearUsuario">
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

                                <button type="button" class=" btn btn-outline-secondary float-right m-1"  data-dismiss="modal">
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
                        <h1>GESTION DE USUARIOS <button type="button" data-toggle="modal" data-target="#crearUsuario"
                                class="btn bg-gradient-primary ml-2">Crear Nuevo Usuario</button></h1>

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





        <!--Contenido-->
        <section>
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Usuario</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" class="form-control float-left"
                                placeholder="Ingrese El Nombre Del Usuario">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="fas fa-search"></i></button></div>
                        </div>

                    </div>
                    <div class="card-body">

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

<script src="../js/Usuario.js"></script>