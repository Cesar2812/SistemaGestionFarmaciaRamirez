<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Font Awesome -->
<link rel="stylesheet" href="../css/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>


<body class="hold-transition sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">


        <!-- Navegacion parte de arriba-->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">SISTEMA DE FARMACIA </a>
                </li>
                <!--<li class="nav-item d-none d-sm-inline-block">
                    
                    <a href="#" class="nav-link">Contact</a>
                </li>-->

            </ul>


            <ul class="navbar-nav ml-auto">
                <button class="btn btn-block btn-danger" id="cerrarSesionBtn">Cerrar
                    Sesion</button>
            </ul>
        </nav>

        <script>

            document.getElementById('cerrarSesionBtn').addEventListener('click', function () {
                Swal.fire({
                    position: "top-end",
                    title: '¿Estás seguro?',
                    text: "¿Deseas cerrar sesión?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cerrar sesión',
                    cancelButtonText: 'No, mantenerme dentro'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../controlador/ControladorDeslogueo.php";
                    }
                });
            });
        </script>

        <!-- Navegacion Parte Izquierda -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Farmacia Ramirez</span>
            </a>

            <!-- Parte donde se contiene el nombre del Usuario Logueado-->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img id="usuario-navb" src="../img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            <?php
                            echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'];
                            ?>
                        </a>
                    </div>
                </div>


                <!-- Menu de la Parte Izquierda -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-header">USUARIO</li>

                        <li class="nav-item">
                            <a href="../vista/edicionUsuarios.php" class="nav-link">
                                <i class="nav-icon fas fa-user-edit"></i>
                                <p>
                                    Editar Datos Del Usuario
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../vista/nuevoUsuario.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Nuevo Usuario
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">ALMACEN</li>

                        <li class="nav-item">
                            <a href="../vista/atributosMedicamentos.php" class="nav-link">
                                <i class="nav-icon fas fa-vials"></i>
                                <p>
                                    Gestion Medicamentos
                                </p>
                            </a>
                        </li>


                    </ul>
                </nav>

            </div>
        </aside>