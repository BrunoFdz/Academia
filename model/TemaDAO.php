<?php

class TemaDAO extends BaseDAO {

    public function __construct() {
        try {
            $this->table = "temas";
            $this->entity = "Tema";
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update($tema) {
        try {
            $stm = "UPDATE temas SET titulo = ?, descripcion=?, curso_id=? WHERE id = ?";
            $this->pdo->prepare($stm)->execute(array($tema->getTitulo(), $tema->getDescripcion(), $tema->getCursoId(), $tema->getId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function add($tema) {
        try {
            $sql = "INSERT INTO temas (titulo, descripcion, curso_id) VALUES (?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array($tema->getTitulo(), $tema->getDescripcion(), $tema->getCursoId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    //Método para mostrar una lista de temas pertenecientes a un curso
    // Recibe el id del curso y devuelve un array con los temas
    public function listarTemasCurso($idCurso) {
        try {
            $sql = "SELECT * FROM temas where curso_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($idCurso));
            return $stm->fetchAll(PDO::FETCH_CLASS, 'Tema');
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

}
