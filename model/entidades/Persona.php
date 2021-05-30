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

    /**
     * Constructor de la clase persona
     * 
     * El constructor asigna al atributo usuario un objeto de la clase Usuario
     */
    function __construct() {
        $this->usuario = new Usuario();
    }

    /**
     * Método utilizado para obtener el id de la persona
     * 
     * @return devuelve el id de la persona
     */
    function getId() {
        return $this->id;
    }

    /**
     * Método utilizado para obtener el nombre de la persona
     * 
     * @return devuelve el nombre de la persona
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * Método utilizado para obtener los apellidos de la persona
     * 
     * @return devuelve los apellidos de la persona
     */
    function getApellidos() {
        return $this->apellidos;
    }

    /**
     * Método utilizado para obtener el correo de la persona
     * 
     * @return devuelve el correo de la persona
     */
    function getCorreo() {
        return $this->correo;
    }

    /**
     * Método utilizado para establecer el id de la persona
     * 
     * @param $id id de la persona
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * Método utilizado para establecer el nombre de la persona
     * 
     * @param $nombre nombre de la persona
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * Método utilizado para establecer los apellidos de la persona
     * 
     * @param $apellidos apellidos de la persona
     */
    function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    /**
     * Método utilizado para establecer el correo de la persona
     * 
     * @param $correo correo de la persona
     */
    function setCorreo($correo): void {
        $this->correo = $correo;
    }

    /**
     * Método utilizado para obtener los datos de usuario de la persona
     * 
     * @return Devuelve un objeto de la clase Usuario
     */
    function getUsuario() {
        return $this->usuario;
    }

    /**
     * Método utilizado para establecer los datos de usuario de la persona
     * 
     * @param Usuario $usuario objeto del tipo usuario
     */
    function setUsuario(Usuario $usuario): void {
        // El id de Usuario es el mismo que el de persona
        $this->usuario->setId($this->getId());
        $this->usuario->setNombreUsuario($usuario->getNombreUsuario());
        $this->usuario->setPassword($usuario->getPassword());
        $this->usuario->setRol($usuario->getRol());
    }

    /**
     * Método utilizado para obtener los cursos de la persona
     * 
     * @return Devuelve un array con los cursos de la persona
     */
    function getCursos() {
        return $this->cursos;
    }

    /**
     * Método utilizado para establecer los cursos de la persona
     * 
     * 
     * @param  $cursos array de cursos
     */
    function setCursos($cursos): void {
        $this->cursos = $cursos;
    }

}
