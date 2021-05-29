<?php

class TemaController {

    private $model;
    private $modeloCurso;
    private $utilidades;

    public function __construct() {
        $this->model = new TemaDAO();
        $this->modeloCurso = new CursoDAO();
        $this->utilidades = new Utilidades();
    }

    //Función para mostrar los temas de un curso recibiendo el id del curso por petición
    public function mostrarTemasCurso() {

        if (isset($_REQUEST['id'])) {

            //Obtenemos el listado de temas
            $temas = $this->model->listarTemasCurso($_REQUEST['id']);

            //Obtenemos el curso 
            $curso = $this->modeloCurso->getById($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/tema/mostrarTemasCurso.php';
        require_once '../view/footer.php';
    }

    //Función que carga el formulario de crear/editar cursos y valida el formulario
    public function vistaEditar() {
        $titulo = $descripcion = "";
        $errorTitulo = $errorDescripcion = "";
        $errores = false;

        if (isset($_REQUEST['bEnviar'])) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
            }

            if (isset($_POST['cursoId'])) {
                $cursoId = $_POST['cursoId'];
            }

            if (empty($_POST['titulo'])) {
                $errorTitulo = "El título es requerido";
                $errores = true;
            } else {
                $titulo = $this->utilidades->filtrarDatos($_POST['titulo']);
            }

            if (empty($_POST['descripcion'])) {
                $errorDescripcion = "La descripción es requerida";
                $errores = true;
            } else {
                $descripcion = $this->utilidades->filtrarDatos($_POST['descripcion']);
            }

            //Si no hay errores guardamos el tema
            if (!$errores) {
                $this->guardar($id, $titulo, $descripcion, $cursoId);
            }
        }

        //Obtenemos el curso
        if (isset($_REQUEST['cursoId'])) {
            $curso = $this->modeloCurso->getById($_REQUEST['cursoId']);
        }

        //Creamos un tema, en caso de que estemos editando uno lo obtendremos a través del id
        $tema = new Tema();
        if (isset($_REQUEST['id'])) {
            $tema = $this->model->getById($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/tema/editarTema.php';
        require_once '../view/footer.php';
    }

    //Método para guardar los cursos . Se utiliza para los nuevos cursos y para actualizar
    public function guardar($id, $titulo, $descripcion, $cursoId) {
        $tema = new Tema();

        $tema->setId($id);
        $tema->setTitulo($titulo);
        $tema->setDescripcion($descripcion);
        $tema->setCursoId($cursoId);

        //Comprobamos si el id es mayor que 0 para saber si es un tema existente o uno nuevo
        $tema->getId() > 0 ? $this->model->update($tema) : $this->model->add($tema);

        header("Location: index.php?c=tema&a=mostrarTemasCurso&id=$cursoId");
    }

    //Funcion para eliminar un curso recibiendo el id del curso por petición
    public function eliminar() {
        
        if (isset($_REQUEST['cursoId'])) {
            $cursoId = $_REQUEST['cursoId'];
        }
        
        $this->model->delete($_REQUEST['id']);
        header("Location: index.php?c=tema&a=mostrarTemasCurso&id=$cursoId");
    }

}
