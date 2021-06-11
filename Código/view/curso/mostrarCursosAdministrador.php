<?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador') { ?>
    <!-- Contenido principal -->
    <main>
        <section class="py-5">
            <div class="container">
                <h1>
                    Todos los cursos
                </h1>
                <hr>          
                <?php foreach ($resultado as $r): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="?c=tema&a=mostrarTemasCurso&id=<?php echo $r->getId(); ?>"><h2><?php echo $r->getNombre(); ?></h2></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="btn" href="?c=persona&a=listarAlumnosCurso&id=<?php echo $r->getId(); ?>">Mostrar Alumnos</a>
                        </div>
                    </div>
    <?php endforeach; ?>
            </div>
        </section>     
    </main>
    <?php
} else {
    header('Location: index.php');
}
?>
