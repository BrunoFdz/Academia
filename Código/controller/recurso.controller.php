<?php
/**
 * Controlador de recursos
 */
class RecursoController {

    private $model;
    private $modeloTema;

    /**
     * Constructor de la clase
     * 
     * Instancia el modelo de recurso y el modelo de tema 
     */
    public function __construct() {
        $this->model = new RecursoDAO();
        $this->modeloTema = new TemaDAO();
    }

    /**
     * Método utilizado para mostrar el tema junto con sus recursos
     * 
     * Recibe el id del tema por petición http. Obtiene el tema y sus recursos 
     * y los carga
     */
    public function mostrarRecursosTema() {

        if (isset($_REQUEST['temaId'])) {

            //Obtenemos el listado de temas
            $recursos = $this->model->listarRecursosTema($_REQUEST['temaId']);

            //Obtenemos el tema
            $tema = $this->modeloTema->getById($_REQUEST['temaId']);
        }

        require_once '../view/header.php';
        require_once '../view/recurso/mostrarRecursosTema.php';
        require_once '../view/footer.php';
    }

    //Función para mostra el formulario para subir un nuevo recurso
    /**
     * Método utilizado para mostrar el formulario para subir un nuevo recurso y lo válida
     */
    public function vistaNuevo() {
        $errorFichero = "";
        $errores = false;

        //Obtenemos el tema a través del id
        $tema = new Tema();
        if (isset($_REQUEST['temaId'])) {
            $tema = $this->modeloTema->getById($_REQUEST['temaId']);
        }
        
        //Comprobamos si el formulario ha sido enviado
        if (isset($_REQUEST['bEnviar'])) {

            if (isset($_POST['temaId'])) {
                $temaId = $_POST['temaId'];
            }

            if (($_FILES["fichero"]["tmp_name"] == "")) {
                $errorFichero = "El fichero es requerido";
                $errores = true;
            } else {
                if ($_FILES["fichero"]["size"] >= 6000000) {
                    $errorFichero = "El fichero es demasiado grande";
                    $errores = true;
                } else {
                    //Obtenemos el nombre del fichero
                    $nombre = $_FILES["fichero"]["name"];
                    $tipo = $_FILES["fichero"]["type"];
                }
            }

            if (!$errores) {
                //Si no hay errores comprobamos si la carpeta para el tema existe, en caso contrario la creamos
                $rutaCarpeta = "../recursos/" . $tema->getTitulo() . "/";
                if (!file_exists($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0777, true);
                }
                //Movemos el archivo
                move_uploaded_file($_FILES["fichero"]["tmp_name"], $rutaCarpeta . $nombre);

                //Guardamos el nombre del archivo en la base de datos
                $this->guardar($nombre, $tipo, $temaId);
            }
        }

        require_once '../view/header.php';
        require_once '../view/recurso/nuevoRecurso.php';
        require_once '../view/footer.php';
    }

    /**
     * Método utilizado para guardar un recurso
     * 
     * @param type $nombre nombre del recurso 
     * @param type $tipo tipo mime del recurso
     * @param type $temaId id del tema del recurso
     */
    public function guardar($nombre, $tipo, $temaId) {
        $recurso = new Recurso();

        $recurso->setNombre($nombre);
        $recurso->setTipoMime($tipo);
        $recurso->setTemaId($temaId);

        //Añadimos el recurso
        $this->model->add($recurso);

        header("Location: index.php?c=Recurso&a=mostrarRecursosTema&temaId=$temaId");
    }

    /**
     * Método utilizado para eliminar un recurso
     * 
     * Recibe el id del recurso por petición http. Primero elimina el archivo de
     * la carpeta y luego elimina la referencia en la base de datos
     */
    public function eliminar() {

        //Obtenemos el recurso y el tema
        if (isset($_REQUEST['id'])) {
            $recurso = new Recurso();

            $recurso = $this->model->getById($_REQUEST['id']);

            $tema = $this->modeloTema->getById($recurso->getTemaId());
            
             //Obtenemos la ruta del archivo
            $rutaArchivo = "../recursos/" . $tema->getTitulo() . "/" . $recurso->getNombre();

            //Eliminamos el archivo de la ruta
            unlink($rutaArchivo);

            //Eliminamos el recurso de la base de datos
            $this->model->delete($recurso->getId());

            header("Location: index.php?c=Recurso&a=mostrarRecursosTema&temaId=" . $tema->getId());
        }
    }

    /**
     * Método utilizado para descargar un recurso 
     * 
     * Recibe el id del recurso por petición. 
     */
    public function descargar() {
        if (isset($_REQUEST['id'])) {
            //Creamos un recurso
            $recurso = new Recurso();

            //Obtenemos los datos del recurso
            $recurso = $this->model->getById($_REQUEST['id']);
            
            //Obtenemos el tema del recurso
            $tema = $this->modeloTema->getById($recurso->getTemaId());

            //Obtenemos la ruta del archivo para poder descargarlo
            $rutaArchivo = "../recursos/" . $tema->getTitulo() . "/" . $recurso->getNombre();

            header("Content-disposition: attachment; filename=".$recurso->getNombre());
            
            header("Content-type: ".$recurso->getTipoMime());

            readfile($rutaArchivo);
            
        }
    }

}
