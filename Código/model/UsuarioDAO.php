<?php

/**
 * 
 * Esta clase nos permitirá realizar las diferentes operaciones con el login 
 * referente a la tabla de usuarios de la base de datos
 * 
 */
class UsuarioDAO {

    /**
     * Constructor de la clase
     * 
     * Obtiene la conexión con la base de datos
     */
    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado en el login para comprobar si el nombre de usuario y contraseña son correctos
     * 
     * @param type $nombreUsuario nombre del usuario que queremos comprobar
     * @param type $password contraseña del password que queremos comprobar
     * @return boolean devuelve true si el nombre de usuario y contraseña son correctos
     */
    public function comprobarLoginUsuario($nombreUsuario, $password) {
        try {
            $resultado = $this->pdo->prepare("SELECT * FROM usuarios WHERE  nombre_usuario = ?");
            $resultado->execute(array($nombreUsuario));

            //Obtenemos el usuario 
            $usuario = $resultado->fetchAll(PDO::FETCH_CLASS, 'Usuario');

            if (count($usuario) > 0) {
                //$usuario contiene un array con usuarios por lo que obtengo el primer usuario (debería de ser el unico ya que nombre_usuario es único)
                //Verificamos que la contraseña coincida con el hash y de ser así devolvemos true
                if (password_verify($password, $usuario[0]->getPassword())) {
                    return true;
                }
            }

            return false;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para obtener el id y el rol del usuario logueado
     * 
     * @param type $nombreUsuario nombre del usuario del que queremos obtener el id y el rol
     * @return Usuario devuelve un objeto de la clase usuario con el id y el rol del usuario
     */
    public function obtenerDatos($nombreUsuario) {
        try {
            $resultado = $this->pdo->prepare("SELECT id, rol FROM usuarios WHERE  nombre_usuario = ? ");
            $resultado->execute(array($nombreUsuario));
            $usuario = $resultado->fetchAll(PDO::FETCH_CLASS, 'Usuario');
            //$usuario contiene un array con usuarios por lo que obtengo el primer usuario (debería de ser el unico ya que nombre_usuario es único)
            return $usuario[0];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
