<?php if (isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador') { ?>
<div class="container my-3 py-5">
    <h1 class="page-header">Actualizar contraseña de <?php echo $usu->getNombreUsuario()?></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?c=Persona&a=vistaEditar&id=<?php echo $usu->getId();?>">Volver a editar</a></li>
        <li class=" breadcrumb-item active">Actualizar contraseña</li>
    </ol>

    <form id="frm-usuario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?c=Persona&a=vistaNuevaPassword&id=<?php echo $usu->getId();?>" method="post">
        
        <input type="hidden" name="id" value="<?php echo $usu->getId(); ?>" />

        <div class="form-group">
            <label>Password <span class="errorFormulario">*</span></label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su password"/>
            <div class="errorFormulario" id="errorPassword"><?php echo $errorPassword; ?></div>
        </div>

        <hr />

        <div class="text-right">
            <button class="btn" name="bEnviar">Guardar</button>
        </div>
    </form>
</div>

<script src="js/actualizarPassword.js"></script>
<?php
} else {
    header('Location: index.php');
}
?>