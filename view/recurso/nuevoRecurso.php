<div class="container my-3 py-5">
    <h1 class="page-header mb-5">Subir recurso</h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?c=Recurso&a=mostrarRecursosTema&temaId=<?php echo $tema->getId(); ?>"><?php echo $tema->getTitulo(); ?></a></li>
        <li class=" breadcrumb-item active">Subir recurso</li>
    </ol>

    <form id="frm-recurso" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?c=Recurso&a=vistaNuevo" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <!-- Mostramos el nombre del curso y envíamos su id -->
            <label for="tema">Tema</label>
            <input class="form-control" type="text" readonly value="<?php echo $tema->getTitulo() ?>">
            <input type = "hidden" name="temaId" value = "<?php echo $tema->getId(); ?>" />
        </div>

        <div class="custom-file my-3">
            <input type="file" class="custom-file-input" name="fichero" id="fichero" >
            <label class="custom-file-label" for="fichero">Seleccionar fichero</label>
            <div class="errorFormulario" id="errorFichero"><?php echo $errorFichero; ?></div>
        </div>

        <hr />

        <div class="text-right">
            <button class="btn" name="bEnviar">Guardar</button>
        </div>
    </form>
</div>
<script src="js/formularioRecurso.js"></script>