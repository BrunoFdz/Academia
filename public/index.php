<?php

/**
 * Autocargador de la aplicación
 * 
 * Este método nos incluye automáticamente las clases utilizadas a lo largo de 
 * la aplicación a medida que las necesitemos.
 * 
 * @param type $clase clase que queremos utilizar
 */
function mi_autocargador($clase){        
    $fichero = $clase.".php";
    
    //Debido a que los ficheros del controlador no coinciden con el nombre de la clase debemos comprobar si se trata de un controlador para realizar los cambios
    // y obtener el nombre de fichero correcto (En el resto el nombre de la clase y el fichero coinciden por lo que no hay problema)
    if(strstr($clase, "Controller")){ //Comprobamos si la clase contiene la palabra Controller
        $clase = strstr($clase, "Controller", true); //Si la tiene cogemos toda la palabra hasta Controller
        $clase = strtolower($clase); //Lo ponemos en minuscula
        $fichero = $clase.".controller.php"; 
    }    
    $rutas = array( //Creamos un array con todas las rutas en las que se encuentras nuestras clases
        dirname(dirname(__FILE__)) ."/bd/",
        dirname(dirname(__FILE__))."/model/",
        dirname(dirname(__FILE__))."/model/entidades/",
        dirname(dirname(__FILE__)) . "/controller/",
        dirname(dirname(__FILE__)) ."/utilidades/"
    );
    
    for ($i = 0; $i < count($rutas);$i++){                
        if(file_exists($rutas[$i].$fichero)){
            require_once $rutas[$i].$fichero;
        }
    }
}

spl_autoload_register('mi_autocargador');




// FrontController
if(!isset($_REQUEST['c']))
{
    require_once '../view/header.php';    
    require_once 'index.html';
    require_once '../view/footer.php';
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    // Instanciamos el controlador
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    
    // Llama a la accion a realizar
    call_user_func( array( $controller, $accion ) );
}