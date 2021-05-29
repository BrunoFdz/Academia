<?php

class UsuarioDAO {

    public function __construct() {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Método utilizado en el login para comprobar si el nombre de usuario y contraseña son correctos
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

    //Método para obtener el id y el rol del usuario logueado
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
