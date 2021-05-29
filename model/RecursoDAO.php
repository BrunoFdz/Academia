<?php

class RecursoDAO extends BaseDAO {

    public function __construct() {
        try {
            $this->table = "recursos";
            $this->entity = "Recurso";
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Los recursos no pueden ser actualizados, habría que eliminarlos y volverlos a subir
    public function update($recurso) {}

    public function add($recurso) {
        try {           
            $sql = "INSERT INTO recursos (nombre, tipo_mime, tema_id) VALUES (?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array($recurso->getNombre(), $recurso->getTipoMime() , $recurso->getTemaId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    //Método para mostrar una lista de recursos pertenecientes a un tema
    // Recibe el id del tema y devuelve un array con los recursos
    public function listarRecursosTema($idTema) {
        try {
            $sql = "SELECT * FROM recursos where tema_id= ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($idTema));
            return $stm->fetchAll(PDO::FETCH_CLASS, 'Recurso');
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

}
