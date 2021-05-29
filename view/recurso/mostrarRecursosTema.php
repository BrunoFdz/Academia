<!-- Contenido principal -->
<main>
    <section class="py-5">
        <div class="container">
            <h1 class="mt-4 mb-3">
                <?php echo $tema->getTitulo(); ?>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?c=tema&a=mostrarTemasCurso&id=<?php echo $tema->getCursoId() ?>">Volver</a></li>
                <li class="breadcrumb-item active"><?php echo $tema->getTitulo(); ?></li>
            </ol>
            <h3>¿Qué verás en este tema?</h3>
            <p style="white-space: pre-line; font-size: 18px;">
                <?php echo $tema->getDescripcion(); ?>
            </p>
            <h3>Recursos</h3>

            <div class="text-right mb-3">
                <a class="btn" href="?c=Recurso&a=vistaNuevo&temaId=<?php echo $tema->getId(); ?>">Nuevo recurso</a>
            </div>

            <?php foreach ($recursos as $recurso): ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <?php echo $recurso->getNombre() ?> 
                        <span class="float-right">
                            <a href="?c=Recurso&a=descargar&id=<?php echo $recurso->getId();?>"><i class="fas fa-file-download"></i> Descargar</a>
                            &nbsp;
                            <a class="peligro" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Recurso&a=eliminar&id=<?php echo $recurso->getId();?>">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </span>
                    </li>
                </ul>
            <?php endforeach; ?>
        </div>
    </section>     
</main>