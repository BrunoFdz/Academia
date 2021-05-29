<!-- Contenido principal -->
    <main>
        <section class="py-5">
            <div class="container">
                <h1>
                    Mis cursos
                </h1>
                <hr>          
                <?php foreach ($resultado as $curso):?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="?c=tema&a=mostrarTemasCurso&id=<?php echo $curso->getId(); ?>"><h2><?php echo $curso->getNombre(); ?></h2></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="btn" href="?c=persona&a=listarAlumnosCurso&id=<?php echo $curso->getId(); ?>">Mostrar Alumnos</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>     
    </main>