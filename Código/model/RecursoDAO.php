<?php

/**
 * 
 * Esta clase nos permitirá realizar las diferentes operaciones referente 
 * a la tabla de recursos con la base de datos
 * 
 */
class RecursoDAO extends BaseDAO {

    /**
     * Constructor de la clase
     * 
     * Establece los atributos heredados de la BaseDAO para hacer referencia 
     * a la tabla recursos y a la clase Recurso. Además obtiene la conexión con la 
     * base de datos
     */
    public function __construct() {
        try {
            $this->table = "recursos";
            $this->entity = "Recurso";
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Los recursos no pueden ser actualizados, habría que eliminarlos y volverlos a subir
     * por lo que este método no hace nada
     * 
     * @ignore
     */
    public function update($recurso) {
        
    }

    /**
     * Método utilizado para añadir los datos de un recurso en la base de datos
     * 
     * @param Recurso $recurso recurso que queremos añadir
     */
    public function add($recurso) {
        try {
            $sql = "INSERT INTO recursos (nombre, tipo_mime, tema_id) VALUES (?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array($recurso->getNombre(), $recurso->getTipoMime(), $recurso->getTemaId()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para obtener una lista de recursos de un tema
     * 
     * @param $idTema id del tema del que queremos obtener los recursos
     * @return array de objetos del tipo recurso
     */
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

    /**
     * Método que devuelve el número de recursos de un tema
     * 
     * @param type $idTema id del tema que queremos obtener el número de recursos
     * @return type número de recursos del tema
     */
    public function numeroTemasCurso($idTema) {
        try {
            $sql = "SELECT id FROM recursos where tema_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($idTema));
            return $stm->rowCount();
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

}
