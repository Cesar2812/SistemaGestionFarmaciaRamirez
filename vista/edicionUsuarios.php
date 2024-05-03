<?php


//ESTE ES EL FORMULARIO DE EDICION DE LOS DATOS DEL USUARIO

//metodo para iniciar la sesion
session_start();
//con este condicional se toma el rol del usuario que se ha logueado 
if ($_SESSION['rol'] == 1) {
    //incluyendo el archivo header del Layout para usarse en todos los formularios de forma global
    include_once 'layouts/header.php';
    ?>
    <title>Edicion Usuarios</title>
    <?php
    include_once 'layouts/navs.php';
    ?>
    <!-- Contenido de la Pagina -->
    <div class="content-wrapper">

        <!-- Contenido de la parte de Arriba en la parte de arriba -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DATOS DEL USUARIO</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vista/administrador.php">Volver a Inicio</a></li>
                            <li class="breadcrumb-item active">Datos Del Usuario</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>



        <!--Contenido de los Datos del Usuario dentro de los card-->
        <section>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-info card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img src="../img/Tamara.jpg" class="profile-user-img img-fluid img-circle">
                                    </div>
                                    <input id="id_Usuario" type="hidden" value="<?php  echo $_SESSION['usuario']//var_dump($_SESSION['usuario'])?>">
                                    <h3 id="nombre_user" class="profile-username  text-center text-dark">
                                        Nombre
                                    </h3>

                                    <p id="apellido_user" class="text-muted text-center">Apellido</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b style="color:black">Nombre De Usuario</b><a id="user_name" class="float-right">12</a>
                                        </li>

                                        <li class="list-group-item">
                                            <b style="color:black">Edad</b><a id="edad"class="float-right">12</a>
                                        </li>

                                        <li class="list-group-item">
                                            <b style="color:black">Rol De Usuario</b><span id="rol"
                                                class=" float-right badge badge-success">Administrador</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Contacto</h3>
                                </div>
                                <div class="card-body">
                                    <strong style="color:black">
                                        <i class="fa fa-phone mr-1"></i>Telefono
                                    </strong>
                                    <p id="telefono"class="text-muted">87844571</p>

                                    <strong style="color:black">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Residensia
                                    </strong>
                                    <p id="residencia"class="text-muted">Granada</p>

                                    <strong style="color:black">
                                        <i class="fa fa-envelope"></i> Correo
                                    </strong>
                                    <p id="correo" class="text-muted">admon_faramirez@gamil.com</p>

                                    <button class="btn btn-block btn-secondary">Editar</button>
                                </div>
                                <div class="card-footer">
                                    <p class="text-muted">Click Si Desea Editar</p>
                                </div>
                            </div>
                        </div>


                        <!--Aca se hace referencia al formulario que esta en medio donde se cargaran los datos para que sean actualizados-->
                        <div class="col-md-9">
                            <div class="card card-info">
                                <div class="card-header">
                                    <he class="card-title">Editar Datos Personales</he>
                                </div>

                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                            <div class="col-sm-10">
                                                <input type="tel" id="telefono" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="residencia" class="col-sm-2 col-form-label">Residencia</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="residencia" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                                            <div class="col-sm-10">
                                                <input type="email" id="correo" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class=" offset-sm-2 col-sm-10 float-right">
                                                <button class="btn btn-block btn-outline-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
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


