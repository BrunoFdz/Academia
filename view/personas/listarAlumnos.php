<div class="container-fluid">
    <h1 class="mt-2">Alumnos</h1>

    <div class="text-right mb-3">
        <a class="btn" href="?c=Persona&a=vistaNuevo">Nuevo alumno</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th style="width:100px;"></th>
                <th style="width:100px;"></th>          
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->model->listarAlumnos() as $u): ?>
                <tr>
                    <td><?php echo $u->nombre; ?></td>
                    <td><?php echo $u->apellidos; ?></td>
                    <td><?php echo $u->correo; ?></td>
                    <td><?php echo $u->nombre_usuario; ?></td>
                    <td><?php echo $u->rol; ?></td>
                    <td>
                        <a href="?c=Persona&a=vistaEditar&id=<?php echo $u->id; ?>"><i class="fas fa-edit"></i> Editar</a>
                    </td>
                    <td>
                        <a class="peligro" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Persona&a=eliminar&id=<?php echo $u->id; ?>">
                            <i class="fas fa-trash-alt"></i> Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
</div>