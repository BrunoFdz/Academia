<?php

class Utilidades {

    //Método para filtrar los datos recibidos y eliminar posible código malicioso
    //Recibe una cadena de texto y la devuelve filtrada
    public function filtrarDatos($datos) {
        $datos = strip_tags($datos);
        $datos = trim($datos);
        $datos = htmlspecialchars($datos, ENT_QUOTES, "ISO-8859-1");
        return $datos;
    }

}
