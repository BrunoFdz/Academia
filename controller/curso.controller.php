<?php
/**
 * Controlador de los cursos
 */
class CursoController {

    private $model;
    private $modeloPersona;
    private $utilidades;

    /**
     * Constructor de la clase
     * 
     * Instancia el modelo de curso, el modelo de personas y la clase utilidades
     */
    public function __construct() {
        $this->model = new CursoDAO();
        $this->modeloPersona = new PersonaDAO();
        $this->utilidades = new Utilidades();
    }

    /**
     * Método utilizado para cargar la vista principal en el que se muestra
     * todos los cursos
     */
    public function index() {
        require_once '../view/header.php';
        require_once '../view/curso/curso.php';
        require_once '../view/footer.php';
    }

    /**
     * Método que carga el formulario de crear/editar cursos y valida el formulario
     * 
     * En caso de que los datos sean correctos llama al método de guardar curso
     */
    public function vistaEditar() {
        //Variables utilizadas para la validación
        $nombre = $profesor = "";
        $errorNombre = $errorProfesor = "";
        $errores = false;

        //Comprobamos si el formulario ha sido enviado
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
        
        //Creamos un curso y en caso de recibir un id obtiene el curso con ese id
        $curso = new Curso();
        if (isset($_REQUEST['id'])) {
            $curso = $this->model->getById($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/curso/curso-editar.php';
        require_once '../view/footer.php';
    }

    /**
     * Método utilizado para guardar los cursos.
     * 
     * Se utiliza para los nuevos cursos y para actualizar los ya existentes
     * 
     * @param type $id  id del curso que queremos guardar
     * @param type $nombre nombre del curso que queremos guardar
     * @param type $profesor id del profesor del curso que queremos guardar
     */
    public function guardar($id, $nombre, $profesor) {
        $curso = new Curso();

        $curso->setId($id);
        $curso->setNombre($nombre);
        $curso->setProfesorId($profesor);

        $curso->getId() > 0 ? $this->model->update($curso) : $this->model->add($curso);

        header('Location: index.php?c=curso');
    }

    /**
     * Método utilizado para eliminar los cursos
     * 
     * Recibe el id del curso por petición http
     */
    public function eliminar() {
        $this->model->delete($_REQUEST['id']);
        header('Location: index.php?c=curso');
    }

    /**
     * Método utilizado para mostrar los cursos de un alumno 
     * 
     * Recibiendo el id del alumno por petición http
     */
    public function mostrarCursosAlumno() {

        if (isset($_REQUEST['id'])) {
            $resultado = $this->model->listarCursosAlumno($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/curso/mostrarCursosAlumno.php';
        require_once '../view/footer.php';
    }

    /**
     * Método utilizado para mostrar los cursos de un profesor
     * 
     * Recibiendo el id del profesor por petición http
     */    
    public function mostrarCursosProfesor() {
        if (isset($_REQUEST['id'])) {
            $resultado = $this->model->listarCursosProfesor($_REQUEST['id']);
        }

        require_once '../view/header.php';
        require_once '../view/curso/mostrarCursosProfesor.php';
        require_once '../view/footer.php';
    }

}
