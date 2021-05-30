<?php
/**
 * Clase persona que representa la tabla de personas en la base de datos
 * 
 * Esta clase de persona representa la tabla de personas en la base de datos
 * y se utiliza en la aplicación para trabajar con POO
 */

class Persona {
    
    private $id;
    private $nombre;
    private $apellidos;    
    private $correo;
    private Usuario $usuario;
    
    //Solo se usa si la persona tiene rol alumno
    private $cursos = array();    
    
    function __construct() {
        $this->usuario = new Usuario();
    }
  
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    function setCorreo($correo): void {
        $this->correo = $correo;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario(Usuario $usuario): void {
        // El id de Usuario es el mismo que el de persona
        $this->usuario->setId($this->getId());
        $this->usuario->setNombreUsuario($usuario->getNombreUsuario());
        $this->usuario->setPassword($usuario->getPassword());
        $this->usuario->setRol($usuario->getRol());
    }
        
    function getCursos() {
        return $this->cursos;
    }

    function setCursos($cursos): void {
        $this->cursos = $cursos;
    }
    
}
