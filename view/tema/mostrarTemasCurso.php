<?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol'])) { ?>
    <!-- Contenido principal -->
    <main>
        <section class="py-5">
            <div class="container">
                <h1>
                    <?php echo $curso->getNombre(); ?>
                </h1>
                <hr>
                <?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && ($_SESSION['rol'] == 'profesor' || $_SESSION['rol'] == 'administrador')) { ?>
                    <div class="text-right mb-3">
                        <a class="btn" href="?c=tema&a=vistaEditar&cursoId=<?php echo $curso->getId(); ?>">Nuevo tema</a>
                    </div>
                <?php } ?>
                <?php foreach ($temas as $tema): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="?c=Recurso&a=mostrarRecursosTema&temaId=<?php echo $tema->getId(); ?>"><h2><?php echo $tema->getTitulo(); ?></h2></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && ($_SESSION['rol'] == 'profesor' || $_SESSION['rol'] == 'administrador')) { ?>
                                <a href="?c=tema&a=vistaEditar&cursoId=<?php echo $tema->getCursoId(); ?>&id=<?php echo $tema->getId(); ?>"><i class="fas fa-edit"></i> Editar</a>
                                &nbsp;
                                <a class="peligro" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=tema&a=eliminar&cursoId=<?php echo $tema->getCursoId(); ?>&id=<?php echo $tema->getId(); ?>">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                            <?php } ?>
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