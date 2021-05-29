<?php

class RecursoController {

    private $model;
    private $modeloTema;

    public function __construct() {
        $this->model = new RecursoDAO();
        $this->modeloTema = new TemaDAO();
    }

    //Función para mostrar un tema y sus recursos
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
    public function vistaNuevo() {
        $errorFichero = "";
        $errores = false;

        //Obtenemos el tema a través del id
        $tema = new Tema();
        if (isset($_REQUEST['temaId'])) {
            $tema = $this->modeloTema->getById($_REQUEST['temaId']);
        }

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

    //Método para guardar el recurso.
    public function guardar($nombre, $tipo, $temaId) {
        $recurso = new Recurso();

        $recurso->setNombre($nombre);
        $recurso->setTipoMime($tipo);
        $recurso->setTemaId($temaId);

        //Añadimos el recurso
        $this->model->add($recurso);

        header("Location: index.php?c=Recurso&a=mostrarRecursosTema&temaId=$temaId");
    }

    //Funcion para eliminar un recurso recibe el id del recurso por petición
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

    //Funcion para descargar un recurso recibe el id del recurso por petición
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
