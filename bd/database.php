<?php

/**
 *  Clase utilizada para la conexión con la base de datos
 *  
 *  Esta clase es utilizada para la conexión con la base de datos con 
 *  un método estático para no tener que instanciar la propia clase
 */
class Database {

    /**
     * Método utilizado para conectarse a la base de datos
     * 
     * @return devuelve la conexión con la base de datos
     */
    public static function connect() {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=academia;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}
