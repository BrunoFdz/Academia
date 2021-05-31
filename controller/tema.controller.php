<?php

/**
 * Controlador de los temas
 */
class TemaController {

    private $model;
    private $modeloCurso;
    private $utilidades;

    /**
     * Constructor de la clase
     * 
     * Instancia el modelo de tema, el modelo de curso y la clase utilidades
     */
    public function __construct() {
        $this->model = new TemaDAO();
        $this->modeloCurso = new CursoDAO();
        $this->utilidades = new Utilidades();
    }

    /**
     * Método utilizado para mostrar los temas de un curso
     * 
     * Recibe el id del curso por petición http
     */
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

    /**
     * Método utilizado para cagar el formulario de crear/editar temas y valida el 
     * formulario
     * 
     * En caso de que los datos sean correctos llama al método guardar
     */
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

    /**
     * Método utilizado para guardar el tema.
     * 
     * Se utiliza para los nuevos temas y para actualizar los ya existentes
     * 
     * @param type $id id del tema
     * @param type $titulo titulo del tema
     * @param type $descripcion descripción del tema
     * @param type $cursoId id del curso del tema
     */
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

    /**
     * Método utilizado para eliminar un tema
     * 
     * Recibe el id del tema por petición http
     */
    public function eliminar() {
        
        if (isset($_REQUEST['cursoId'])) {
            $cursoId = $_REQUEST['cursoId'];
        }
        
        $this->model->delete($_REQUEST['id']);
        header("Location: index.php?c=tema&a=mostrarTemasCurso&id=$cursoId");
    }

}
