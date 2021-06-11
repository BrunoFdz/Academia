<?php

/**
 * Clase recurso que representa la tabla de recursos en la base de datos
 * 
 * Esta clase de recurso representa la tabla de recursos en la base de datos
 * y se utiliza en la aplicación para trabajar con POO
 */
class Recurso {

    private $id;
    private $nombre;
    private $tipo_mime;
    private $tema_id;

    /**
     * Método utilizado para obtener el id del recurso
     * 
     * @return devuelve el id del recurso
     */
    function getId() {
        return $this->id;
    }

    /**
     * Método utilizado para obtener el nombre del recurso
     * 
     * @return devuelve el nombre del recurso
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * Método utilizado para obtener el tipo mime del recurso
     * 
     * @return devuelve el tipo mime del recurso
     */
    function getTipoMime() {
        return $this->tipo_mime;
    }

    /**
     * Método utilizado para obtener el id del tema del recurso
     * 
     * @return devuelve el id del tema del recurso
     */
    function getTemaId() {
        return $this->tema_id;
    }

    /**
     * Método utilizado para establecer el id del recurso
     * 
     * @param $id id del recurso
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * Método utilizado para establecer el nombre del recurso
     * 
     * @param $nombre nombre del recurso
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * Método utilizado para establecer el tipo mime del recurso
     * 
     * @param $tipo_mime tipo mime del recurso
     */
    function setTipoMime($tipo_mime): void {
        $this->tipo_mime = $tipo_mime;
    }

    /**
     * Método utilizado para establecer el id del tema del recurso
     * 
     * @param $tema_id id del tema del recurso
     */
    function setTemaId($tema_id): void {
        $this->tema_id = $tema_id;
    }

}
