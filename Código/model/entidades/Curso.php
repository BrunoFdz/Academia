<?php

/**
 * Clase curso que representa la tabla de cursos en la base de datos
 * 
 * Esta clase de curso representa la tabla de cursos en la base de datos
 * y se utiliza en la aplicación para trabajar con POO
 */
class Curso {

    private $id;
    private $nombre;
    private $profesor_id;

    /**
     * Método utilizado para obtener el id del curso
     * 
     * @return devuelve el id del curso
     */
    function getId() {
        return $this->id;
    }

    /**
     * Método utilizado para obtener el nombre del curso
     * 
     * @return devuelve el nombre del curso
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * Método utilizado para obtener el id del profesor del curso
     * 
     * @return devuelve el id del profesor del curso
     */
    function getProfesorId() {
        return $this->profesor_id;
    }

    /**
     * Método utilizado para establecer el id del curso
     * 
     * @param $id id del curso
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * Método utilizado para establecer el nombre del curso
     * 
     * @param $nombre nombre del curso
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * Método utilizado para establecer el id del profesor del curso
     * 
     * @param $profesor_id id del profesor del curso
     */
    function setProfesorId($profesor_id): void {
        $this->profesor_id = $profesor_id;
    }

}
