<?php
/**
 * Clase usuario que representa la tabla de usuarios en la base de datos
 * 
 * Esta clase de usuario representa la tabla de cursos en la base de datos
 * y se utiliza en la aplicación para trabajar con POO
 */
class Usuario
{
       
    private $id;
    private $nombre_usuario;
    private $password;
    private $rol;        
    
    function getId() {
        return $this->id;
    }

    function getNombreUsuario() {
        return $this->nombre_usuario;
    }

    function getPassword() {
        return $this->password;
    }

    function getRol() {
        return $this->rol;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombreUsuario($nombre_usuario): void {
        $this->nombre_usuario = $nombre_usuario;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setRol($rol): void {
        $this->rol = $rol;
    }

}