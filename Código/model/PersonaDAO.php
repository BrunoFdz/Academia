<?php

/**
 * 
 * Esta clase nos permitirá realizar las diferentes operaciones referente 
 * a las tablas de personas y usuarios con la base de datos
 * 
 */
class PersonaDAO extends BaseDAO {

    /**
     * Constructor de la clase
     * 
     * Establece los atributos heredados de la BaseDAO para hacer referencia 
     * a la tabla personas y a la clase Persona. Además obtiene la conexión con la 
     * base de datos
     */
    public function __construct() {
        try {
            $this->table = "personas";
            $this->entity = "Persona";
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para obtener todos los datos de todos los usuarios 
     * 
     * @return array de objetos con los datos de las tablas personas y usuarios
     */
    public function listarUsuarios() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM personas INNER JOIN usuarios using(id)");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para obtener todos los datos de los usuarios que son profesores
     * 
     * @return array de objetos con los datos de las tablas personas y usuarios de los profesores
     */
    public function listarProfesores() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM personas INNER JOIN usuarios using(id) where rol = 'profesor'");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para obtener todos los datos de los usuarios que son alumnos
     * 
     * @return array de objetos con los datos de las tablas personas y usuarios de los alumnos
     */
    public function listarAlumnos() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM personas INNER JOIN usuarios using(id) where rol = 'alumno'");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para añadir los datos de una persona en la base de datos
     * 
     * @param Persona $persona
     */
    public function add($persona) {
        try {
            //Variable utilizada para comprobar que todas las operaciones salieron bien
            $correcto = true;
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO personas(nombre, apellidos, correo) VALUES (?,?,?)";

            //Execute devuelve true si todo fue correcto y false si hubo algún error, guardamos el resultado en una variable
            $resultado = $this->pdo->prepare($sql)->execute(array($persona->getNombre(), $persona->getApellidos(), $persona->getCorreo()));

            //En caso de que el resultado sea false indicamos que hubo un error
            if (!$resultado) {
                $correcto = false;
            }

            //Obtenemos el id de la persona que acabamos de insertar
            $idPersona = $this->pdo->lastInsertId();

            $sql2 = "INSERT INTO usuarios (id, nombre_usuario, password, rol) VALUES (?, ?, ?, ?)";

            //Obtenemos la clase usuario a través de la clase persona
            $usuario = $persona->getUsuario();

            //Insetamos en la tabla usuarios los datos
            $resultado = $this->pdo->prepare($sql2)->execute(array($idPersona, $usuario->getNombreUsuario(), $usuario->getPassword(), $usuario->getRol()));
            if (!$resultado) {
                $correcto = false;
            }

            //Comprobamos que el rol sea alumno
            if ($usuario->getRol() == 'alumno') {
                //Comprobamos que tenga cursos
                if (count($persona->getCursos()) > 0) {
                    $sql3 = "INSERT INTO curso_alumno(alumno_id, curso_id) VALUES (?, ?)";
                    foreach ($persona->getCursos() as $cursoid) {
                        $resultado = $this->pdo->prepare($sql3)->execute(array($idPersona, $cursoid));
                        if (!$resultado) {
                            $correcto = false;
                        }
                    }
                }
            }
            //Si todo fue bien hacemos el commit
            if ($correcto) {
                $this->pdo->commit();
                //De lo contrario hacemos rollback
            } else {
                $this->pdo->rollback();
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para actualizar los datos de una persona en la base de datos
     * 
     * @param Persona $persona
     */
    public function update($persona) {
        try {
            //Variable utilizada para comprobar que todas las operaciones salieron bien
            $correcto = true;
            $this->pdo->beginTransaction();

            $sql = "UPDATE personas SET nombre = ?, apellidos = ?, correo = ? WHERE id = ? ";

            $resultado = $this->pdo->prepare($sql)->execute(array($persona->getNombre(), $persona->getApellidos(), $persona->getCorreo(), $persona->getId()));

            //En caso de que el resultado sea false indicamos que hubo un error
            if (!$resultado) {
                $correcto = false;
            }

            $sql2 = "UPDATE usuarios SET nombre_usuario = ?, rol = ? WHERE id = ? ";

            $usuario = $persona->getUsuario();

            $resultado = $this->pdo->prepare($sql2)->execute(array($usuario->getNombreUsuario(), $usuario->getRol(), $persona->getId()));
            //En caso de que el resultado sea false indicamos que hubo un error
            if (!$resultado) {
                $correcto = false;
            }

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
                        $resultado = $this->pdo->prepare($sql3)->execute(array($persona->getId(), $cursoid));
                        if (!$resultado) {
                            $correcto = false;
                        }
                    }
                }
            }
            //Si todo fue bien hacemos el commit
            if ($correcto) {
                $this->pdo->commit();
                //De lo contrario hacemos rollback
            } else {
                $this->pdo->rollback();
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para obtener todos los datos de las tablas persona y usuario de la base de datos de una persona por su id 
     * 
     * @param $id id de la persona de la que queremos obtener sus datos
     */
    public function obtenerDatosId($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM personas INNER JOIN usuarios using(id) WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetch((PDO::FETCH_OBJ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método utilizado para comprobar si un email está disponible 
     * 
     * @param $email
     * @return boolean devuelve falso si el email ya esta siendo utilizado y true si está libre
     */
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

    /**
     * Método utilizado para comprobar si un nombre de usuario está disponible 
     * 
     * @param $nombreUsuario
     * @return boolean devuelve falso si el nombre de usuario ya esta siendo utilizado y true si está libre 
     */
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

    /**
     * Método utilizado para actualizar la contraseña de un usuario
     * 
     * @param Usuario $usuario objeto del tipo usuario con los datos del usuario
     */
    public function actualizarPassword($usuario) {
        try {

            $sql = "UPDATE usuarios SET password = ? where id = ?";
            $this->pdo->prepare($sql)->execute(array($usuario->getPassword(), $usuario->getId()));
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    //Método para obtener un listado de alumnos que asisten a un curso
    //Por parámetro recibe el id del curso

    /**
     * Método utilizado para obtener un listado de alumnos que asisten a un curso
     * 
     * @param type $idCurso id del curso del que queremos obtener los alumnos
     * @return array de personas que asisten al curso
     */
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
