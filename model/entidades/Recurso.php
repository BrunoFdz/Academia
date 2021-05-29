<?php

class Recurso {
    
    private $id;
    private $nombre;
    private $tipo_mime;
    private $tema_id;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTipoMime() {
        return $this->tipo_mime;
    }

    function getTemaId() {
        return $this->tema_id;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setTipoMime($tipo_mime): void {
        $this->tipo_mime = $tipo_mime;
    }

    function setTemaId($tema_id): void {
        $this->tema_id = $tema_id;
    }

}
