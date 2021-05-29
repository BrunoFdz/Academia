<?php

abstract class BaseDAO {
    protected $pdo;
    protected $table;
    protected $entity;
    
    public function findAll() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM $this->table");            
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_CLASS, $this->entity);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
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
    
    public function delete($id) {
        try {
            $stm = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
     abstract public function add($objeto);
     
     abstract public function update($objeto);
}
