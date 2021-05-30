<?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && ($_SESSION['rol'] == 'profesor' || $_SESSION['rol'] == 'administrador')) { ?>
    <div class="container my-3 py-5">
        <h1 class="page-header mb-5"><?php echo $tema->getId() != null ? $tema->getTitulo() : 'Nuevo Tema'; ?></h1> 

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?c=tema&a=mostrarTemasCurso&id=<?php echo $curso->getId(); ?>">Curso</a></li>
            <li class=" breadcrumb-item active"><?php echo $tema->getId() != null ? $tema->getTitulo() : 'Nuevo Tema'; ?></li>
        </ol>

        <form id="frm-tema" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?c=Tema&a=vistaEditar" method="post">
            <!-- Comprobamos si el curso tiene id -->
            <?php
            if ($tema->getId() != null) {
                ?>
                <input type = "hidden" name = "id" value = "<?php echo $tema->getId(); ?>" />
                <?php
            }
            ?>

            <div class="form-group">
                <!-- Mostramos el nombre del curso y envíamos su id -->
                <label for="curso">Curso</label>
                <input class="form-control" type="text" readonly value="<?php echo $curso->getNombre() ?>">
                <input type = "hidden" name = "cursoId" value = "<?php echo $curso->getId(); ?>" />
            </div>

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" value="<?php echo $tema->getId() != null ? $tema->getTitulo() : $titulo; ?>" class="form-control" placeholder="Ingrese el título del tema"/>
                <div class="errorFormulario" id="errorTitulo"><?php echo $errorTitulo; ?></div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="12"><?php echo $tema->getId() != null ? $tema->getDescripcion() : $descripcion; ?></textarea>
                <div class="errorFormulario" id="errorDescripcion"><?php echo $errorDescripcion; ?></div>
            </div>

            <hr />

            <div class="text-right">
                <button class="btn" name="bEnviar">Guardar</button>
            </div>
        </form>
    </div>
    <script src="js/formularioTema.js"></script>
<?php
} else {
    header('Location: index.php');
}
?>