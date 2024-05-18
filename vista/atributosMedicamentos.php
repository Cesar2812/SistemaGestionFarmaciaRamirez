<?php
//ESTA ES LA VISTA PARA CREAR LOS ATRIBUTOS DE LOS MEDICAMENTOS


//iniciando la sesion 
session_start();
//validando si se cumple la condicion de que el usuario logueado tenga el rol de administrador para que el formulario pueda cargar 
if ($_SESSION['rol'] === 1 || $_SESSION['rol'] === 3) {
    //incluyendo el archivo header del Layout para usarse en todos los formularios de forma global
    include_once 'layouts/header.php';
    ?>
    <title>Gestion Atributo</title>
    <?php
    //archivo que contiene las barras de navegacion de la izquierda
    include_once 'layouts/navs.php';
    ?>

    <!-- Modal para cambiar Logo  -->
    <div class="modal fade" id="cambiarLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Cambiar Logo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="logo-img" src="../img/user.png" class="profile-user-img img-fluid img-circle">
                    </div>

                    <div class="text-center">
                        <b id="nombre_lab">

                        </b>
                    </div>


                    <div class="alert alert-danger text-center" id="nocambiado" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>Formato de Imagen Incorrecto</span>
                    </div>

                    <form id="form-logo" enctype="multipart/form-data">

                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="foto" class="input-group">
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_logo_lab" id="id_logo_lab">
                        </div>



                        <div class="modal-footer">
                            <button type="button" class=" btn btn-danger" data-dismiss="modal">
                                Cerrar
                            </button>
                            <!--<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>-->
                            <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- Modal para Insertar un nuevo Laboratorio-->
    <div class="modal fade" id="crearLaboratorio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="card card-light">
                    <div class="card-header">
                        <h2 class="card-title">Crear o Editar Laboratorio</h2>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger text-center" id="noADD" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>Ya Existe Un Laboratorio Con Este Nombre</span>
                        </div>

                        <form id="crearLab">
                            <div class="form-group">
                                <label for="nombre-laboratorio">Nombre Del Laboratorio</label>
                                <input id="nombre-laboratorio" type="text" class="form-control"
                                    placeholder="Ingrese El Nombre" required>
                                   
                            </div>

                            <div class="form-group">
                                <label for="telefono-laboratorio">Telefono Del Laboratorio</label>
                                <input id="telefono-laboratorio" type="text" class="form-control"
                                    placeholder="Ingrese El Telefono" required>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-primary float-right m-1">
                                    Guardar
                                </button>

                                <button type="button" class=" btn btn-danger float-right m-1" data-dismiss="modal">
                                    Cerrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



   










    <!-- Modal para Insertar una Nueva Categoria-->
    <div class="modal fade" id="crearCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="card card-light">
                    <div class="card-header">
                        <h2 class="card-title">Crear Categoria</h2>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger text-center" id="noAgregado" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>No Se Permite Ingresar con el Mismo Nombre De
                                Usuario</span>
                        </div>

                        <form id="crearCategoria">
                            <div class="form-group">
                                <label for="nombre-categoria">Nombre De La Categoria</label>
                                <input id="nombre-categoria" type="text" class="form-control"
                                    placeholder="Ingrese El Nombre" required>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-primary float-right m-1">
                                    Guardar
                                </button>

                                <button type="button" class=" btn btn-danger float-right m-1" data-dismiss="modal">
                                    Cerrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para Insertar una Nueva Presentacion-->
    <div class="modal fade" id="crearPresentacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="card card-light">
                    <div class="card-header">
                        <h2 class="card-title">Crear Presentacion Del Medicamento</h2>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger text-center" id="noAgregado" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>No Se Permite Ingresar con el Mismo Nombre De
                                Usuario</span>
                        </div>

                        <form id="crearPresentacion">
                            <div class="form-group">
                                <label for="nombre-categoria">Nombre De La Presentacion</label>
                                <input id="nombre-categoria" type="text" class="form-control"
                                    placeholder="Ingrese El Nombre" required>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-primary float-right m-1">
                                    Guardar
                                </button>

                                <button type="button" class=" btn btn-danger float-right m-1" data-dismiss="modal">
                                    Cerrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>






























    <!-- Contenido de la Pagina en la Parte de Arriba -->
    <div class="content-wrapper">
        <!-- Contenido de la parte de Arriba -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>GESTION DE ATRIBUTOS DE MEDICAMENTOS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vista/administrador.php">Volver a Inicio</a></li>
                            <li class="breadcrumb-item active">Atributos</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contenido de La Pagina -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a href="#laboratorio" class="nav-link active"
                                            data-toggle="tab">Laboratorio</a></li>
                                    <li class="nav-item"><a href="#categoria" class="nav-link"
                                            data-toggle="tab">Categoria</a></li>
                                    <li class="nav-item"><a href="#presentacion" class="nav-link"
                                            data-toggle="tab">Presentacion</a></li>
                                </ul>


                            </div>
                            <div class="card-body p-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="laboratorio">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <div class="card-title">Buscar Laboratorio <button type="button"
                                                        data-toggle="modal" data-target="#crearLaboratorio"
                                                        class="btn bg-gradient-success btn-sm m-2">Crear Laboratorio

                                                    </button>
                                                </div>
                                                <div class="input-group">
                                                    <input id="buscar_lab" type="text" class="form-control float-left"
                                                        placeholder="Ingrese el Nombre del Laboratorio">
                                                    <div class="input-group-append"><button class="btn btn-default"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0 table-responsive">

                                                <table class="table table-hover text-nowrap">
                                                    <thead class="table-secondary">
                                                        <tr>
                                                            <th>LABORATORIO</th>
                                                            <th>TELEFONO</th>
                                                            <th>LOGO</th>
                                                            <th>OPCIONES</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="table-active" id="table_lab">

                                                    </tbody>
                                                </table>








                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="categoria">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <div class="card-title">Buscar Categoria <button type="button"
                                                        data-toggle="modal" data-target="#crearCategoria"
                                                        class="btn bg-gradient-success btn-sm m-2">Crear Categoria

                                                    </button>
                                                </div>
                                                <div class="input-group">
                                                    <input id="buscar-lab" type="text" class="form-control float-left"
                                                        placeholder="Ingrese el Nombre de la Categoria">
                                                    <div class="input-group-append"><button class="btn btn-default"><i
                                                                class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body"></div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="presentacion">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <div class="card-title">Buscar Presentacion<button type="button"
                                                        data-toggle="modal" data-target="#crearPresentacion"
                                                        class="btn bg-gradient-success btn-sm m-2">Crear Presentacion

                                                    </button>
                                                </div>
                                                <div class="input-group">
                                                    <input id="buscar-lab" type="text" class="form-control float-left"
                                                        placeholder="Ingrese el Nombre de la Presentacion">
                                                    <div class="input-group-append"><button class="btn btn-default"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body"></div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
    </div>
    <?php
    //archivo que contiene las diversas funciones en el formulario con JS
    include_once 'layouts/funciones.php';
} else {
    header('Location:../index.php');
}
?>
<script src="../js/Laboratorios.js"></script>