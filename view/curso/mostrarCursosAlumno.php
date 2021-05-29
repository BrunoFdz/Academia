<!-- Contenido principal -->
    <main>
        <section class="py-5">
            <div class="container">
                <h1>
                    Mis cursos
                </h1>
                <hr>          
                <?php foreach ($resultado as $r):?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="?c=tema&a=mostrarTemasCurso&id=<?php echo $r->getId(); ?>"><h2><?php echo $r->getNombre(); ?></h2></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            Profesor: <?php echo $this->modeloPersona->getById($r->getProfesorId())->getNombre(). " "
                                    .$this->modeloPersona->getById($r->getProfesorId())->getApellidos()
                                    .". Correo: ".$this->modeloPersona->getById($r->getProfesorId())->getCorreo();?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>     
    </main>