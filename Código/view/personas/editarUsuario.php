<?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador') { ?>
<div class="container my-3 py-5">
    <h1 class="page-header">
        <?php echo $per->getNombre(); ?>
    </h1>

    <ol class="breadcrumb align-items-center">
        <li class="breadcrumb-item"><a href="?c=Persona">Usuarios</a></li>
        <li class="breadcrumb-item active"><?php echo $per->getNombre(); ?></li>
        <li class="ml-auto"><a class="btn btn-sm" href="?c=Persona&a=vistaNuevaPassword&id=<?php echo $per->getId(); ?>">Cambiar contraseña</a></li>
    </ol>

    <form id="frm-usuario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?c=Persona&a=vistaEditar" method="post">
        <input type="hidden" name="id" value="<?php echo $per->getId(); ?>" />

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $per->getNombre(); ?>" class="form-control" placeholder="Ingrese su nombre"/>
            <div class="errorFormulario" id="errorNombre"><?php echo $errorNombre; ?></div>
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $per->getApellidos(); ?>" class="form-control" placeholder="Ingrese su apellido"/>
            <div class="errorFormulario" id="errorApellidos"><?php echo $errorApellidos; ?></div>
        </div>

        <div class="form-group">
            <label>Correo</label>
            <input type="text" name="correo" id="correo" value="<?php echo $per->getCorreo(); ?>" class="form-control" placeholder="Ingrese su correo electrónico"/>
            <div class="errorFormulario" id="errorCorreo"><?php echo $errorCorreo; ?></div>
        </div>

        <!--Campo que guarda el email original para la validación con ajax, en caso de que el valor de el email cambie se comprobará que no exista ese email en la bd-->
        <input type="hidden" name="correoOriginal" id="correoOriginal" value="<?php echo $per->getCorreo(); ?>" />

        <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="nombreUsuario" id="nombreUsuario" value="<?php echo $per->getUsuario()->getNombreUsuario(); ?>" class="form-control" placeholder="Ingrese su nombre de usuario"/>
            <div class="errorFormulario" id="errorNombreUsuario"><?php echo $errorNombreUsuario; ?></div>
        </div>

        <!--Campo que guarda el nombre de usuario original para la validación con ajax, en caso de que el valor de el nombre de usuario cambie se comprobará que no exista en la bd-->
        <input type="hidden" name="nombreUsuarioOriginal" id="nombreUsuarioOriginal" value="<?php echo $per->getUsuario()->getNombreUsuario(); ?>" />

        <div class="form-group">
            <div>Rol</div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rol" id="alumno" value="alumno" <?php if ($per->getUsuario()->getRol() == "alumno") echo "checked" ?>>
                <label class="form-check-label" for="alumno">Alumno</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rol" id="profesor" value="profesor"  <?php if ($per->getUsuario()->getRol() == "profesor") echo "checked" ?>>
                <label class="form-check-label" for="profesor">Profesor</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rol" id="administrador" value="administrador"  <?php if ($per->getUsuario()->getRol() == "administrador") echo "checked" ?>>
                <label class="form-check-label" for="administrador">Administrador</label>
            </div>
            <div class="errorFormulario" id="errorRol"><?php echo $errorRol; ?></div>
        </div>            

        <div class="row" id="listaCursos">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cursos">Cursos</label>
                    <select class="form-control" name="cursos[]" multiple>
                        <?php foreach ($this->modeloCurso->findAll() as $c): ?>
                            <option value="<?php echo $c->getId(); ?>" <?php
                            if (in_array($c, $per->getCursos())) {
                                echo "selected";
                            }?>>
                                <?php echo $c->getNombre(); ?>
                            </option>         
                        <?php endforeach; ?>
                    </select>
                    <div class="errorFormulario" id="errorCursos"><?php echo $errorCursos; ?></div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div>
                    <h5>Cursos en los que el alumno está matriculado:</h5>
                    <ul>
                        <?php foreach ($per->getCursos() as $cu): ?>
                            <li><?php echo $cu->getNombre(); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <hr />

        <div class="text-right">
            <button class="btn"name="bEnviar">Guardar</button>
        </div>
    </form>
</div>

<script src="js/formularioEditarUsuario.js"></script>
<?php
} else {
    header('Location: index.php');
}
?>