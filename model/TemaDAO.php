<?php

/**
 * 
 * Esta clase nos permitirá realizar las diferentes operaciones referente 
 * a la tabla de temas con la base de datos
 * 
 */
class TemaDAO extends BaseDAO {

    /**
     * Constructor de la clase
     * 
     * Establece los atributos heredados de la BaseDAO para hacer referencia 
     * a la tabla temas y a la clase Tema. Además obtiene la conexión con la 
     * base de datos
     */
    public function __construct() {
        try {
            $this->table = "temas";
            $this->entity = "Tema";
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para actualizar los datos de un tema en la base de datos
     * 
     * @param Tema $tema tema que queremos actualizar
     */
    public function update($tema) {
        try {
            $stm = "UPDATE temas SET titulo = ?, descripcion=?, curso_id=? WHERE id = ?";
            $this->pdo->prepare($stm)->execute(array($tema->getTitulo(), $tema->getDescripcion(), $tema->getCursoId(), $tema->getId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para añadir los datos de un tema en la base de datos
     * 
     * @param Tema $tema
     */
    public function add($tema) {
        try {
            $sql = "INSERT INTO temas (titulo, descripcion, curso_id) VALUES (?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array($tema->getTitulo(), $tema->getDescripcion(), $tema->getCursoId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para obtener una lista de temas pertenecientes a un curso
     * 
     * @param $idCurso id del curso del que queremos obtener los temas
     * @return array de temas pertenecientes al curso
     */
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

    /**
     * Método que devuelve el número de temas de un curso
     * 
     * @param type $idCurso id del curso que queremos obtener el número de tema
     * @return type número de temas del curso
     */
    public function numeroTemasCurso($idCurso) {
        try {
            $sql = "SELECT id FROM temas where curso_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($idCurso));
            return $stm->rowCount();
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

}
