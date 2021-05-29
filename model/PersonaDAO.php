<?php

class PersonaDAO extends BaseDAO {

    public function __construct() {
        try {
            $this->table = "personas";
            $this->entity = "Persona";
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listarUsuarios() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM personas INNER JOIN usuarios using(id)");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    public function listarProfesores() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM personas INNER JOIN usuarios using(id) where rol = 'profesor'");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    public function listarAlumnos() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM personas INNER JOIN usuarios using(id) where rol = 'alumno'");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    public function add($persona) {
        try {
            $sql = "INSERT INTO personas(nombre, apellidos, correo) VALUES (?,?,?)";
            $this->pdo->prepare($sql)->execute(array($persona->getNombre(), $persona->getApellidos(), $persona->getCorreo()));

            //Obtenemos el id de la persona que acabamos de insertar
            $idPersona = $this->pdo->lastInsertId();

            $sql2 = "INSERT INTO usuarios (id, nombre_usuario, password, rol) VALUES (?, ?, ?, ?)";

            //Obtenemos la clase usuario a través de la clase persona
            $usuario = $persona->getUsuario();

            //Insetamos en la tabla usuarios los datos
            $this->pdo->prepare($sql2)->execute(array($idPersona, $usuario->getNombreUsuario(), $usuario->getPassword(), $usuario->getRol()));

            //Comprobamos que el rol sea alumno
            if ($usuario->getRol() == 'alumno') {
                //Comprobamos que tenga cursos
                if (count($persona->getCursos()) > 0) {
                    $sql3 = "INSERT INTO curso_alumno(alumno_id, curso_id) VALUES (?, ?)";
                    foreach ($persona->getCursos() as $cursoid) {
                        $this->pdo->prepare($sql3)->execute(array($idPersona, $cursoid));
                    }
                }
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update($persona) {
        try {
            $sql = "UPDATE personas SET nombre = ?, apellidos = ?, correo = ? WHERE id = ? ";

            $this->pdo->prepare($sql)->execute(array($persona->getNombre(), $persona->getApellidos(), $persona->getCorreo(), $persona->getId()));

            $sql2 = "UPDATE usuarios SET nombre_usuario = ?, rol = ? WHERE id = ? ";

            $usuario = $persona->getUsuario();

            $this->pdo->prepare($sql2)->execute(array($usuario->getNombreUsuario(), $usuario->getRol(), $persona->getId()));

            //Comprobamos que el rol sea alumno
            if ($usuario->getRol() == 'alumno') {
                //Comprobamos que tenga cursos
                if (count($persona->getCursos()) > 0) {
                    //Eliminamos los cursos anteriores
                    $stm = $this->pdo->prepare("delete from curso_alumno where alumno_id = ?");
                    $stm->execute(array($persona->getId()));

                    //Insertamos los nuevos cursos
                    $sql3 = "INSERT INTO curso_alumno(alumno_id, curso_id) VALUES (?, ?)";
                    foreach ($persona->getCursos() as $cursoid) {
                        $this->pdo->prepare($sql3)->execute(array($persona->getId(), $cursoid));
                    }
                }
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Método que obtiene todos los datos de un usuario por su id (los datos de la tabla persona y de la tabla usuarios)
    public function obtenerDatosId($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM personas INNER JOIN usuarios using(id) WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetch((PDO::FETCH_OBJ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Comprobar si un email esta disponible
    //Recibe un email como argumento y comprueba si ya existe ese email, si existe devuelve false
    public function comprobarEmail($email) {
        try {
            $query = "SELECT correo FROM personas WHERE correo=:email";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(':email' => $email));

            //Si el correo electrónico ya existe devuelve false de lo contrario true
            if ($stmt->rowCount() == 1) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    //Comprobar si un nombre de usuario esta disponible
    //Recibe un nombre de usuario como argumento y comprueba si ya existe, si existe devuelve false
    public function comprobarNombreUsuario($nombreUsuario) {
        try {
            $query = "SELECT nombre_usuario FROM usuarios WHERE nombre_usuario=:nombreUsuario";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(':nombreUsuario' => $nombreUsuario));

            //Si el nombre de usuario ya existe devuelve false de lo contrario true
            if ($stmt->rowCount() == 1) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    //Método para actualizar la password de un usuario
    //Por parámetro recibe un objeto del tipo Usuario
    public function actualizarPassword($usuario) {
        try{
            
            $sql = "UPDATE usuarios SET password = ? where id = ?";
            $this->pdo->prepare($sql)->execute(array($usuario->getPassword(),$usuario->getId()));
            
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }
    
    //Método para obtener un listado de alumnos que asisten a un curso
    //Por parámetro recibe el id del curso
        public function listarAlumnosCurso($idCurso) {
        try {
            $sql = "SELECT personas.nombre, personas.apellidos, personas.correo FROM personas "
                    . "INNER JOIN curso_alumno on personas.id=curso_alumno.alumno_id "
                    . "where curso_alumno.curso_id = ?";

            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($idCurso));
            return $stm->fetchAll(PDO::FETCH_CLASS, 'Persona');
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

}
