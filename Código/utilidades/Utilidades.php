<?php
/**
 * Clase utilizada para guardar funciones que pueden ser utilizadas
 * por el resto de clases
 */
class Utilidades {

    /**
     * Método utilizado para filtrar los datos recibidos y eliminar posible código malicioso
     * 
     * @param String $datos
     * @return String devuelve la cadena recibidad después de filtrarla
     */
    public function filtrarDatos($datos) {
        $datos = strip_tags($datos);
        $datos = trim($datos);
        $datos = htmlspecialchars($datos, ENT_QUOTES, "ISO-8859-1");
        return $datos;
    }

}
