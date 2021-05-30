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
   
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCursoId() {
        return $this->curso_id;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    function setCursoId($curso_id): void {
        $this->curso_id = $curso_id;
    }

}
