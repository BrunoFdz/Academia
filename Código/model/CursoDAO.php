<?php

/**
 * 
 * Esta clase nos permitirá realizar las diferentes operaciones referente 
 * a los cursos con la base de datos
 * 
 */
class CursoDAO extends BaseDAO {

    /**
     * Constructor de la clase
     * 
     * Establece los atributos heredados de la BaseDAO para hacer referencia 
     * a la tabla cursos y a la clase Curso. Además obtiene la conexión con la 
     * base de datos
     */
    public function __construct() {
        try {
            $this->table = "cursos";
            $this->entity = "Curso";
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para actualizar los datos de un curso en la base de datos
     * 
     * @param Curso $curso curso que queremos actualizar
     */
    public function update($curso) {
        try {
            $stm = "UPDATE cursos SET nombre = ?, profesor_id=? WHERE id = ?";
            $this->pdo->prepare($stm)->execute(array($curso->getNombre(), $curso->getProfesorId(), $curso->getId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para añadir los datos de un curso en la base de datos
     * 
     * @param Curso $curso curso que queremos añadir
     */
    public function add($curso) {
        try {
            $sql = "INSERT INTO cursos (nombre, profesor_id) VALUES (?, ?)";
            $this->pdo->prepare($sql)->execute(array($curso->getNombre(), $curso->getProfesorId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para obtener una lista de cursos en las que un alumno está matriculado
     * 
     * @param $idAlumno id del alumno del que queremos obtener los cursos
     * @return array de cursos a los que asiste el alumno
     */
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

    /**
     * Método utilizado para obtener una lista de cursos impartidos por un profesor
     * 
     * @param $idProfesor id del profesor del que queremos obtener los cursos
     * @return array de cursos que imparte el profesor
     */
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
