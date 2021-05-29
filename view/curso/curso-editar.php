<div class="container my-3 py-5">
    <h1 class="page-header"><?php echo $curso->getId() != null ? $curso->getNombre() : 'Nuevo Curso'; ?></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?c=Curso">Cursos</a></li>
        <li class=" breadcrumb-item active"><?php echo $curso->getId() != null ? $curso->getNombre() : 'Nuevo Curso'; ?></li>
    </ol>

    <form id="frm-curso" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?c=Curso&a=vistaEditar" method="post">
        <!-- Comprobamos si el curso tiene id -->
        <?php
            if($curso->getId() != null){
        ?>
            <input type = "hidden" name = "id" value = "<?php echo $curso->getId(); ?>" />
        <?php
            }         
        ?>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?php echo $curso->getId() != null ? $curso->getNombre() : $nombre; ?>" class="form-control" placeholder="Ingrese el nombre del curso"/>
            <div class="errorFormulario" id="errorNombre"><?php echo $errorNombre; ?></div>
        </div>

        <div class="form-group">
            <label for="profesor">Profesor</label>
            <select class="form-control" id="profesor" name="profesor">
                <option value="">Seleccione un profesor</option>
                <?php foreach ($this->modeloPersona->listarProfesores() as $u): ?>
                <option value="<?php echo $u->id; ?>" <?php if ($u->id == $curso->getProfesorId()) {echo "selected";} elseif ($u->id == $profesor) {echo "selected";}?>>
                        <?php
                        echo $u->nombre;
                        echo " ";
                        echo $u->apellidos;
                        ?>
                    </option>         
                <?php endforeach; ?>
            </select>
            <div class="errorFormulario" id="errorProfesor"><?php echo $errorProfesor; ?></div>
        </div>


        <hr />

        <div class="text-right">
            <button class="btn" name="bEnviar">Guardar</button>
        </div>
    </form>
</div>
<script src="js/formularioCurso.js"></script>