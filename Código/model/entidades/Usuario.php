<?php

/**
 * Clase usuario que representa la tabla de usuarios en la base de datos
 * 
 * Esta clase de usuario representa la tabla de cursos en la base de datos
 * y se utiliza en la aplicación para trabajar con POO
 */
class Usuario {

    private $id;
    private $nombre_usuario;
    private $password;
    private $rol;

    /**
     * Método utilizado para obtener el id del usuario
     * 
     * @return devuelve el id del usuario
     */
    function getId() {
        return $this->id;
    }

    /**
     * Método utilizado para obtener el nombre de usuario del usuario
     * 
     * @return devuelve el nombre de usuario del usuario
     */
    function getNombreUsuario() {
        return $this->nombre_usuario;
    }

    /**
     * Método utilizado para obtener la contraseña del usuario
     * 
     * @return devuelve la contraseña del usuario
     */
    function getPassword() {
        return $this->password;
    }

    /**
     * Método utilizado para obtener el rol del usuario
     * 
     * @return devuelve el rol del usuario
     */    
    function getRol() {
        return $this->rol;
    }

    /**
     * Método utilizado para establecer el id del usuario
     * 
     * @param $id id del usuario
     */      
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * Método utilizado para establecer el nombre de usuario del usuario
     * 
     * @param $nombre_usuario nombre de usuario del usuario
     */      
    function setNombreUsuario($nombre_usuario): void {
        $this->nombre_usuario = $nombre_usuario;
    }

    /**
     * Método utilizado para establecer la contraseña del usuario
     * 
     * @param $password contraseña del usuario
     */    
    function setPassword($password): void {
        $this->password = $password;
    }

    /**
     * Método utilizado para establecer el rol del usuario
     * 
     * @param $id rol del usuario
     */    
    function setRol($rol): void {
        $this->rol = $rol;
    }

}
