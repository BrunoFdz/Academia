<?php

/**
 * Clase tema que representa la tabla de tema en la base de datos
 * 
 * Esta clase de tema representa la tabla de tema en la base de datos
 * y se utiliza en la aplicación para trabajar con POO
 */
class Tema {

    private $id;
    private $titulo;
    private $descripcion;
    private $curso_id;

    /**
     * Método utilizado para obtener el id del tema
     * 
     * @return devuelve el id del tema
     */
    function getId() {
        return $this->id;
    }

    /**
     * Método utilizado para obtener el título del tema
     * 
     * @return devuelve el título del tema
     */
    function getTitulo() {
        return $this->titulo;
    }

    /**
     * Método utilizado para obtener la descripción del tema
     * 
     * @return devuelve la descripción del tema
     */    
    function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Método utilizado para obtener el id del curso del tema
     * 
     * @return devuelve el id del tema
     */    
    function getCursoId() {
        return $this->curso_id;
    }

    /**
     * Método utilizado para establecer el id del tema
     * 
     * @param $id id del tema
     */   
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * Método utilizado para establecer el título del recurso
     * 
     * @param $titulo titulo del recurso
     */    
    function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    /**
     * Método utilizado para establecer la descripción del recurso
     * 
     * @param $descripcion descripción del recurso
     */    
    function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    /**
     * Método utilizado para establecer el id del curso del recurso
     * 
     * @param $curso_id id del curso del recurso
     */    
    function setCursoId($curso_id): void {
        $this->curso_id = $curso_id;
    }

}
