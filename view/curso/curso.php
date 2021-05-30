<?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador') { ?>
    <div class="container-fluid">
        <h1 class="mt-2">Cursos</h1>

        <div class="text-right mb-3">
            <a class="btn" href="?c=Curso&a=vistaEditar">Nuevo curso</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Profesor</th>
                    <th>Correo Profesor</th>
                    <th style="width:100px;"></th>
                    <th style="width:100px;"></th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->model->findAll() as $r): ?>
                    <tr>
                        <td><?php echo $r->getNombre(); ?></td>
                        <td><?php
                            echo $this->modeloPersona->getById($r->getProfesorId())->getNombre() . " "
                            . $this->modeloPersona->getById($r->getProfesorId())->getApellidos();
                            ?></td>
                        <td><?php echo $this->modeloPersona->getById($r->getProfesorId())->getCorreo(); ?></td>
                        <td>
                            <a href="?c=curso&a=vistaEditar&id=<?php echo $r->getId(); ?>"><i class="fas fa-edit"></i> Editar</a>
                        </td>
                        <td>
                            <a class="peligro" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Curso&a=eliminar&id=<?php echo $r->getId(); ?>">
                                <i class="fas fa-trash-alt"></i> Eliminar</a>
                        </td>
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
