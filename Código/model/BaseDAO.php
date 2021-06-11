<?php

/**
 * Clase baseDAO, es una clase abstracta, padre del resto de clases DAO
 * 
 * Esta clase es utilizada para recopilar los métodos comúnes entre todas 
 * las clases DAO de la aplicación. Esta clase nos permitirá realizar
 * las diferentes operaciones con la base de datos
 * 
 * @abstract
 */
abstract class BaseDAO {

    protected $pdo;
    protected $table;
    protected $entity;

    /**
     * Función que obtiene todos los elementos de una tabla y los devuelve
     * como un objeto de la clase indicada
     *     
     * @return Devuelve un array de objetos de una clase indicada en el atributo
     * entity
     *
     */
    public function findAll() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM $this->table");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_CLASS, $this->entity);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Función que obtiene un registro de la tabla cuyo id sea igual al que se
     * le pasa por parámetro y lo devuelvo como un objeto de la clase indicada
     *     
     * @param Id del registro que queremos obtener
     * 
     * @return Devuelve un objeto con los datos del registro
     *
     */
    public function getById($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM $this->table WHERE id = ?");

            $stm->execute(array($id));
            return $stm->fetchObject($this->entity);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Función para eliminar un registro de la tabla cuyo id sea igual al que
     * se le pasa por parametro
     *     
     * @param Id del registro que queremos eliminar
     *      
     */
    public function delete($id) {
        try {
            $stm = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método abstracto para que las clases hijas lo hereden y servirá para 
     * añadir un registro a la base de datos
     * 
     * @param Object Objeto de la clase referente a la tabla en 
     * la base de datos
     */
    abstract public function add($objeto);

    /**
     * Método abstracto para que las clases hijas lo hereden y servirá para 
     * actualizar un registro a la base de datos
     *      
     * @param Object Objeto de la clase referente a la tabla en 
     * la base de datos
     */
    abstract public function update($objeto);
}
