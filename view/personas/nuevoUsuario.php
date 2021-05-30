<?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador') { ?>
    <div class="container my-3 py-5">
        <h1 class="page-header">Nuevo Usuario</h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?c=Persona">Usuarios</a></li>
            <li class=" breadcrumb-item active">Nuevo Usuario</li>
        </ol>

        <form id="frm-usuario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?c=Persona&a=vistaNuevo" method="post">

            <div class="form-group">
                <label>Nombre <span class="errorFormulario">*</span></label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese su nombre" value="<?php echo $nombre; ?>"/>
                <div class="errorFormulario" id="errorNombre"><?php echo $errorNombre; ?></div>
            </div>

            <div class="form-group">
                <label>Apellidos <span class="errorFormulario">*</span></label>
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese sus apellidos" value="<?php echo $apellidos; ?>"/>
                <div class="errorFormulario" id="errorApellidos"><?php echo $errorApellidos; ?></div>
            </div>

            <div class="form-group">
                <label>Correo <span class="errorFormulario">*</span></label>
                <input type="text" name="correo" id="correo" class="form-control" placeholder="Ingrese su correo electrónico" value="<?php echo $correo; ?>"/>
                <div class="errorFormulario" id="errorCorreo"><?php echo $errorCorreo; ?></div>
            </div>   

            <div class="form-group">
                <label>Nombre de usuario <span class="errorFormulario">*</span></label>
                <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" placeholder="Ingrese su nombre de usuario" value="<?php echo $nombreUsuario; ?>"/>
                <div class="errorFormulario" id="errorNombreUsuario"><?php echo $errorNombreUsuario; ?></div>
            </div>

            <div class="form-group">
                <label>Password <span class="errorFormulario">*</span></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su password"/>
                <div class="errorFormulario" id="errorPassword"><?php echo $errorPassword; ?></div>
            </div>


            <div class="form-group">
                <div>Rol <span class="errorFormulario">*</span></div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rol" id="alumno" value="alumno" <?php if ($rol == "alumno") echo "checked" ?>>
                    <label class="form-check-label" for="alumno">Alumno</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rol" id="profesor" value="profesor"  <?php if ($rol == "profesor") echo "checked" ?>>
                    <label class="form-check-label" for="profesor">Profesor</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rol" id="administrador" value="administrador"  <?php if ($rol == "administrador") echo "checked" ?>>
                    <label class="form-check-label" for="administrador">Administrador</label>
                </div>
                <div class="errorFormulario" id="errorRol"><?php echo $errorRol; ?></div>
            </div>

            <div class="form-group" id="listaCursos">
                <label for="cursos">Cursos <span class="errorFormulario">*</span></label>
                <select class="form-control" name="cursos[]" multiple id="cursos">
                    <?php foreach ($this->modeloCurso->findAll() as $c): ?>
                        <option value="<?php echo $c->getId(); ?>" <?php
                        if (in_array($c->getId(), $cursos)) {
                            echo "selected";
                        }
                        ?>>
                                    <?php echo $c->getNombre(); ?>
                        </option>         
                    <?php endforeach; ?>
                </select>
                <div class="errorFormulario" id="errorCursos"><?php echo $errorCursos; ?></div>
            </div>

            <hr />

            <div class="text-right">
                <button class="btn" name="bEnviar">Guardar</button>
            </div>
        </form>
    </div>

    <script src="js/formularioNuevoUsuario.js"></script>
    <?php
} else {
    header('Location: index.php');
}
?>