<?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && ($_SESSION['rol'] == 'profesor' || $_SESSION['rol'] == 'administrador')) { ?>
    <div class="container text-center">
        <h1 class="mt-3">Alumnos</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $u): ?>
                    <tr>
                        <td><?php echo $u->getNombre(); ?></td>
                        <td><?php echo $u->getApellidos(); ?></td>
                        <td><?php echo $u->getCorreo(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
    </div>
<?php
} else {
    header('Location: index.php');
}
?>
