<?php

class CursoDAO extends BaseDAO {

    public function __construct() {
        try {
            $this->table = "cursos";
            $this->entity = "Curso";
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update($curso) {
        try {
            $stm = "UPDATE cursos SET nombre = ?, profesor_id=? WHERE id = ?";
            $this->pdo->prepare($stm)->execute(array($curso->getNombre(), $curso->getProfesorId(), $curso->getId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function add($curso) {
        try {
            $sql = "INSERT INTO cursos (nombre, profesor_id) VALUES (?, ?)";
            $this->pdo->prepare($sql)->execute(array($curso->getNombre(), $curso->getProfesorId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Método para mostrar una lista de cursos en las que un alumno está matriculado
    // Recibe el id del alumno y devuelve un array con los cursos a los que asiste
    public function listarCursosAlumno($idAlumno) {
        try {
            $sql = "SELECT cursos.id, cursos.nombre, cursos.profesor_id FROM cursos "
                    . "INNER JOIN curso_alumno on cursos.id=curso_alumno.curso_id "
                    . "where curso_alumno.alumno_id = ?";

            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($idAlumno));
            return $stm->fetchAll(PDO::FETCH_CLASS, 'Curso');
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    //Método para mostrar una lista de cursos impartidos por un profesor
    // Recibe el id del profesor y devuelve un array con los cursos a los que asiste
    public function listarCursosProfesor($idProfesor) {
        try {
            $sql = "SELECT * FROM cursos where profesor_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($idProfesor));
            return $stm->fetchAll(PDO::FETCH_CLASS, 'Curso');
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }        

}
