<?php

class Curso {
    private $id;
    private $nombre;
    private $profesor_id;    
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getProfesorId() {
        return $this->profesor_id;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setProfesorId($profesor_id): void {
        $this->profesor_id = $profesor_id;
    }       

}
