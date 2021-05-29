<?php

class CursoController {

    private $model;
    private $modeloPersona;
    private $utilidades;

    public function __construct() {
        $this->model = new CursoDAO();
        $this->modeloPersona = new PersonaDAO();
        $this->utilidades = new Utilidades();
    }

    public function index() {
        require_once '../view/header.php';
        require_once '../view/curso/curso.php';
        require_once '../view/footer.php';
    }

    //Función que carga el formulario de crear/editar cursos y valida el formulario
    public function vistaEditar() {
        $nombre = $profesor = "";
        $errorNombre = $errorProfesor = "";
        $errores = false;

        if (isset($_REQUEST["bEnviar"])) {
            if(isset($_POST['id'])){
                $id = $_POST['id'];
            }
            
            if (empty($_POST['nombre'])) {
                $errorNombre = "El nombre es requerido";
                $errores = true;
            } else {
                $nombre = $this->utilidades->filtrarDatos($_POST['nombre']);
            }

            if (empty($_POST['profesor'])) {
                $errorProfesor = "El profesor es requerido";
                $errores = true;
            } else {
                $profesor = $_POST['profesor'];
            }
            
            //Si no tiene errores añadimos al usuario
            if(!$errores){
                $this->guardar($id, $nombre, $profesor);
            }
            
        }
        
        $curso = new Curso();
        if (isset($_REQUEST['id'])) {
            $curso = $this->model->getById($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/curso/curso-editar.php';
        require_once '../view/footer.php';
    }

    //Método para guardar los cursos . Se utiliza para los nuevos cursos y para actualizar
    public function guardar($id, $nombre, $profesor) {
        $curso = new Curso();

        $curso->setId($id);
        $curso->setNombre($nombre);
        $curso->setProfesorId($profesor);

        $curso->getId() > 0 ? $this->model->update($curso) : $this->model->add($curso);

        header('Location: index.php?c=curso');
    }

    //Funcion para eliminar un curso recibiendo el id del curso por petición
    public function eliminar() {
        $this->model->delete($_REQUEST['id']);
        header('Location: index.php?c=curso');
    }

    //Función para mostrar los cursos de un alumno recibiendo el id del alumno por petición
    public function mostrarCursosAlumno() {

        if (isset($_REQUEST['id'])) {
            $resultado = $this->model->listarCursosAlumno($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/curso/mostrarCursosAlumno.php';
        require_once '../view/footer.php';
    }

    //Función para mostrar los cursos de un profesor recibiendo el id del profesor por petición
    public function mostrarCursosProfesor() {
        if (isset($_REQUEST['id'])) {
            $resultado = $this->model->listarCursosProfesor($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/curso/mostrarCursosProfesor.php';
        require_once '../view/footer.php';
    }

}
