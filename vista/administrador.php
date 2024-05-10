<?php
//ESTA ES LA PAGINA PRINCIPAL DEL USUARIO ADMINISTRADOR


//iniciando la sesion 
session_start();
//validando si se cumple la condicion de que el usuario logueado tenga el rol de administrador para que el formulario pueda cargar 
if ($_SESSION['rol'] === 1||$_SESSION['rol']===3) {
    //incluyendo el archivo header del Layout para usarse en todos los formularios de forma global
    include_once 'layouts/header.php';
    ?>
    <title>Sistema Farmacia Ramirez</title>
    <?php
    //archivo que contiene las barras de navegacion de la izquierda
    include_once 'layouts/navs.php';
    ?>


    <script>
        Swal.fire({
            position: "Center",
            icon: "success",
            title: "Bienvenido al Sistema\n <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ?>",
            showConfirmButton: false,
            timer: 1515
        });
    </script>

    <!-- Contenido de la Pagina en la Parte de Arriba -->

    <div class="content-wrapper">
        <!-- Contenido de la parte de Arriba -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Titulo del Contenido</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>






        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                            title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    Start creating your amazing application!
                </div>
                <div class="card-footer">
                    Footer
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