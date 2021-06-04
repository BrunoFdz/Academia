<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FI Academia</title>

        <!-- Importamos el bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="fontawesome/css/all.css">

        <!-- CSS personalizado general -->
        <link rel="stylesheet" href="css/estilos.css">

        <!-- Fuente -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>

    <body>
        <header>
            <!-- Navegador -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <!-- Logo -->
                    <a class="navbar-brand" href="index.php">
                        <img class="img-fluid" src="img/logo.png" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07"
                            aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navegacion -->
                    <div class="collapse navbar-collapse" id="navbarsExample07">

                        <ul class="navbar-nav mr-auto text-center">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Inicio </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cursos.php">Cursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contacto.php">Contacto</a>
                            </li>
                        </ul>

                        <!-- Navegación si es alumno-->

                        <?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'alumno') { ?>
                            <ul class="navbar-nav ml-auto mr-5 text-center">
                                <li class="nav-item text-white">
                                    <a class="nav-link" href="index.php?c=Curso&a=mostrarCursosAlumno&id=<?php echo $_SESSION['idUsuario']; ?>">Mis cursos</a>
                                </li>
                            </ul>
                        <?php } ?>

                        <!-- Navegación si es profesor-->

                        <?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'profesor') { ?>
                            <ul class="navbar-nav ml-auto mr-5 text-center">
                                <li class="nav-item text-white">
                                    <a class="nav-link" href="index.php?c=Curso&a=mostrarCursosProfesor&id=<?php echo $_SESSION['idUsuario']; ?>">Mis cursos</a>
                                </li>
                            </ul>
                        <?php } ?>

                        <!-- Navegación si es administrador-->
                        <?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador') { ?>
                            <ul class="navbar-nav ml-auto mr-5 text-center">
                                <li class="nav-item text-white">
                                    <a class="nav-link" href="index.php?c=Curso&a=mostrarCursosAdministrador">Mostrar cursos</a>
                                </li>
                                <li class="nav-item text-white">
                                    <a class="nav-link" href="index.php?c=Persona">Usuarios</a>
                                </li>
                                <li class="nav-item text-white">
                                    <a class="nav-link" href="index.php?c=Persona&a=listarProfesores">Profesores</a>
                                </li>
                                <li class="nav-item text-white">
                                    <a class="nav-link" href="index.php?c=Persona&a=listarAlumnos">Alumnos</a>
                                </li>
                                <li class="nav-item text-white">
                                    <a class="nav-link" href="index.php?c=Curso">Cursos</a>
                                </li>
                            </ul>
                        <?php } ?>

                        <?php
                        if (isset($_SESSION['idUsuario'])) {
                            echo '<a class="nav-link text-center btn" href="index.php?c=Usuario&a=logout">Cerrar Sesión <i class="fas fa-door-open"></i></a>';
                        } else {
                            echo '<a class="nav-link text-center btn" href="login.php">Login <i class="fas fa-sign-in-alt"></i></a>';
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </header>