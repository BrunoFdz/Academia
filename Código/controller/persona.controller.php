<?php
/**
 * Controlador de personas
 */
class PersonaController {

    private $model;
    private $modeloCurso;
    private $utilidades;

    /**
     * Constructor de la clase
     * 
     * Instancia el modelo de persona, el modelo de curso y clase utilidades
     */
    public function __construct() {
        $this->model = new PersonaDAO();
        $this->modeloCurso = new CursoDAO();
        $this->utilidades = new Utilidades();
    }

    /**
     * Método utilizado para cargar la vista principal en el que se muestra
     * todos los usuarios
     */
    public function index() {
        require_once '../view/header.php';
        require_once '../view/personas/personas.php';
        require_once '../view/footer.php';
    }

    /**
     * Método utilizado para cargar la vista de listar profesores en el que
     * se muestra todos los profesores
     */
    public function listarProfesores() {
        require_once '../view/header.php';
        require_once '../view/personas/listarProfesores.php';
        require_once '../view/footer.php';
    }

    /**
     * Método utilizado para cargar la vista de listar alumnos en el que
     * se muestra todos los alumnos 
     */
    public function listarAlumnos() {
        require_once '../view/header.php';
        require_once '../view/personas/listarAlumnos.php';
        require_once '../view/footer.php';
    }
    
    /**
     * Método utilizado para mostrar todos los alumnos de un curso 
     * 
     * Recibe el id del curso por petición http
     */
    public function listarAlumnosCurso() {
        if (isset($_REQUEST['id'])) {
            $alumnos = $this->model->listarAlumnosCurso($_REQUEST['id']);
        }
        require_once '../view/header.php';
        require_once '../view/curso/mostrarAlumnosCurso.php';
        require_once '../view/footer.php';
    }

    /**
     * Método que carga el formulario de nuevo usuario y también lo válida.
     * 
     * En caso de que los datos sean correctos llama al método para insertar el nuevo usuario
     */
    public function vistaNuevo() {
        //Limpiamos las variables utilizadas
        $nombre = $apellidos = $correo = $nombreUsuario = $password = $rol = '';
        $cursos = array();
        $errorNombre = $errorApellidos = $errorCorreo = $errorNombreUsuario = $errorPassword = $errorRol = $errorCursos = '';
        $errores = false;

        //Expresión regular para comprobar que solo permite letras y espacios
        $expLetras = "/^[áéíóúÁÉÍOÚa-zA-Z-' ]*$/";

        //Comprobamos que se haya enviado el formulario
        if (isset($_REQUEST["bEnviar"])) {

            //Comprobamos si se ha introducido un nombre
            if (empty($_POST['nombre'])) {
                $errorNombre = "El nombre es requerido";
                $errores = true;
            } else {
                $nombre = $this->utilidades->filtrarDatos($_POST['nombre']);
                //Comprobamos que el nombre solo contenga letras y espacios
                if (preg_match($expLetras, $nombre) != 1) {
                    $errorNombre = "El nombre solo puede contener letras y espacios";
                    $errores = true;
                }
            }

            if (empty($_POST['apellidos'])) {
                $errorApellidos = "Los apellidos son requeridos";
                $errores = true;
            } else {
                $apellidos = $this->utilidades->filtrarDatos($_POST['apellidos']);

                //Comprobamos que los apellidos solo contengan letras y espacios
                if (preg_match($expLetras, $apellidos) != 1) {
                    $errorApellidos = "Los apellidos solo pueden contener letras y espacios";
                    $errores = true;
                }
            }

            if (empty($_POST['correo'])) {
                $errorCorreo = "El correo es requerido";
                $errores = true;
            } else {
                $correo = $this->utilidades->filtrarDatos($_POST['correo']);

                //Comprobamos que el correo tenga un formato válido
                if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    $errorCorreo = "El correo no tiene un formato válido";
                    $errores = true;
                } else {
                    //Comprobamos si el email existe ya en la base de datos
                    if (!$this->emailValido($correo)) {
                        $errorCorreo = "El correo ya existe";
                        $errores = true;
                    }
                }
            }

            if (empty($_POST['nombreUsuario'])) {
                $errorNombreUsuario = "El nombre de usuario es requerido";
                $errores = true;
            } else {
                $nombreUsuario = $this->utilidades->filtrarDatos($_POST['nombreUsuario']);

                //Comprobamos si el nombre de usuario existe ya en la base de datos
                if (!$this->nombreUsuarioValido($nombreUsuario)) {
                    $errorNombreUsuario = "El nombre de usuario ya existe";
                    $errores = true;
                }
            }

            if (empty($_POST['password'])) {
                $errorPassword = "El password es requerido";
                $errores = true;
            } else {
                $password = $this->utilidades->filtrarDatos($_POST['password']);

                //Comprobamos que la contraseña tenga como mínimo 8 caracteres
                if (strlen($password) < 8) {
                    $errorPassword = "La contraseña debe tener como mínimo 8 carácteres";
                    $errores = true;
                } else {

                    $expPassword = "/^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/";

                    //Comprobamos que la contraseña tenga como mínimo una minúscula, una mayúscula y un número
                    if (preg_match($expPassword, $password) != 1) {
                        $errorPassword = "La contraseña debe tener como mínimo una minúscula, una mayúscula y un número";
                        $errores = true;
                    }
                }
            }

            //Comprobamos que se seleccione un rol
            if (!isset($_POST['rol'])) {
                $errorRol = "El rol es requerido";
                $errores = true;
            } else {
                $rol = $this->utilidades->filtrarDatos($_POST['rol']);

                //Comprobamos que el usuario sea alumno y de ser así comprobamos que tenga al menos un curso asignado
                if ($rol == 'alumno') {
                    if (!isset($_POST['cursos'])) {
                        $errorCursos = "Al menos un curso es requerido";
                        $errores = true;
                    } else {
                        $cursos = $_POST['cursos'];
                    }
                }
            }

            //Si no tiene errores añadimos al usuario
            if (!$errores) {
                $this->nuevo($nombre, $apellidos, $correo, $nombreUsuario, $password, $rol, $cursos);
            }
        }

        require_once '../view/header.php';
        require_once '../view/personas/nuevoUsuario.php';
        require_once '../view/footer.php';
    }

    /**
     * Método para insertar un nuevo usuario
     * 
     * Recibe por parámetros los datos del usuario y llama al método add de personaDAO para insertar el usuario
     * 
     * @param type $nombre nombre del usuario
     * @param type $apellidos apellidos del usuario
     * @param type $correo correo del usuario
     * @param type $nombreUsuario nombre de usuario del usuario
     * @param type $password contraseña del usuario
     * @param type $rol rol del usuario
     * @param type $cursos cursos del usuarios en caso de ser alumno
     */
    public function nuevo($nombre, $apellidos, $correo, $nombreUsuario, $password, $rol, $cursos) {
        $per = new Persona();

        $per->setNombre($nombre);
        $per->setApellidos($apellidos);
        $per->setCorreo($correo);

        //Creamos un nuevo usuario y añadimos los datos
        $usu = new Usuario();
        $usu->setNombreUsuario($nombreUsuario);

        //Ciframos la contraseña 
        $passwordCifrada = password_hash($password, PASSWORD_DEFAULT);
        $usu->setPassword($passwordCifrada);

        $usu->setRol($rol);

        //Agregamos el usuario a la persona
        $per->setUsuario($usu);

        //Añadimos los cursos
        $per->setCursos($cursos);

        //Insertamos a la persona
        $this->model->add($per);

        //Redirigimos al listado de usuarios
        header('Location: index.php?c=Persona');
    }

    /**
     * Método que carga el formulario de editar usuario y también lo válida
     * 
     * En caso de que los datos sean correctos llama al método para actualizar al usuario
     */
    public function vistaEditar() {
        //Limpiamos las variables utilizadas
        $nombre = $apellidos = $correo = $nombreUsuario = $password = $rol = '';
        $cursos = array();
        $errorNombre = $errorApellidos = $errorCorreo = $errorNombreUsuario = $errorPassword = $errorRol = $errorCursos = '';
        $errores = false;

        //Expresión regular para comprobar que solo permite letras y espacios
        $expLetras = "/^[áéíóúÁÉÍOÚa-zA-Z-' ]*$/";

        //Una vez enviado el formulario se valida
        //Comprobamos que se haya enviado el formulario
        if (isset($_REQUEST["bEnviar"])) {
            $id = $_POST['id'];

            //Comprobamos si se ha introducido un nombre
            if (empty($_POST['nombre'])) {
                $errorNombre = "El nombre es requerido";
                $errores = true;
            } else {
                $nombre = $this->utilidades->filtrarDatos($_POST['nombre']);
                //Comprobamos que el nombre solo contenga letras y espacios
                if (preg_match($expLetras, $nombre) != 1) {
                    $errorNombre = "El nombre solo puede contener letras y espacios";
                    $errores = true;
                }
            }

            if (empty($_POST['apellidos'])) {
                $errorApellidos = "Los apellidos son requeridos";
                $errores = true;
            } else {
                $apellidos = $this->utilidades->filtrarDatos($_POST['apellidos']);

                //Comprobamos que los apellidos solo contengan letras y espacios
                if (preg_match($expLetras, $apellidos) != 1) {
                    $errorApellidos = "Los apellidos solo pueden contener letras y espacios";
                    $errores = true;
                }
            }

            if (empty($_POST['correo'])) {
                $errorCorreo = "El correo es requerido";
                $errores = true;
            } else {
                $correo = $this->utilidades->filtrarDatos($_POST['correo']);

                //Comprobamos que el correo tenga un formato válido
                if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    $errorCorreo = "El correo no tiene un formato válido";
                    $errores = true;
                } else {
                    //Comprobamos si el correo ha sido modificado
                    if ($correo !== $_POST['correoOriginal']) {
                        //Comprobamos si el email existe ya en la base de datos
                        if (!$this->emailValido($correo)) {
                            $errorCorreo = "El correo ya existe";
                            $errores = true;
                        }
                    }
                }
            }

            if (empty($_POST['nombreUsuario'])) {
                $errorNombreUsuario = "El nombre de usuario es requerido";
                $errores = true;
            } else {
                $nombreUsuario = $this->utilidades->filtrarDatos($_POST['nombreUsuario']);

                // Comprobamos si el nombre de usuario ha sido modificado
                if ($nombreUsuario !== $_POST['nombreUsuarioOriginal']) {
                    //Comprobamos si el nombre de usuario existe ya en la base de datos
                    if (!$this->nombreUsuarioValido($nombreUsuario)) {
                        $errorNombreUsuario = "El nombre de usuario ya existe";
                        $errores = true;
                    }
                }
            }

            //Comprobamos que se seleccione un rol
            if (!isset($_POST['rol'])) {
                $errorRol = "El rol es requerido";
                $errores = true;
            } else {
                $rol = $this->utilidades->filtrarDatos($_POST['rol']);

                //Comprobamos que el usuario sea alumno y de ser así comprobamos que tenga al menos un curso asignado
                if ($rol == 'alumno') {
                    if (!isset($_POST['cursos'])) {
                        $errorCursos = "Al menos un curso es requerido";
                        $errores = true;
                    } else {
                        $cursos = $_POST['cursos'];
                    }
                }
            }

            //Si no tiene errores actualizamos al usuario
            if (!$errores) {
                $this->update($id, $nombre, $apellidos, $correo, $nombreUsuario, $rol, $cursos);
            }
        }

        $per = new Persona();

        if (isset($_REQUEST['id'])) {
            //Obtenemos todos los datos de la persona junto a los datos de la tabla usuarios
            $datos = $this->model->obtenerDatosId($_REQUEST['id']);

            //Asignamos los datos recuperados de la consulta
            $per->setId($datos->id);
            $per->setNombre($datos->nombre);
            $per->setApellidos($datos->apellidos);
            $per->setCorreo($datos->correo);

            $usu = new Usuario();
            $usu->setNombreUsuario($datos->nombre_usuario);
            $usu->setRol($datos->rol);

            $per->setUsuario($usu);

            if ($usu->getRol() == 'alumno') {
                //Obtenemos los cursos que tiene el alumno
                $cursos = $this->modeloCurso->listarCursosAlumno($per->getId());
                $per->setCursos($cursos);
            }
        }

        require_once '../view/header.php';
        require_once '../view/personas/editarUsuario.php';
        require_once '../view/footer.php';
    }

    /**
     * Método para actualizar un usuario
     * 
     * Recibe por parámetros los datos del usuario y llama al método update de personaDAO para actualizar el usuario
     * 
     * @param type $id id del usuario
     * @param type $nombre nombre del usuario
     * @param type $apellidos apellidos del usuario
     * @param type $correo correo del usuario
     * @param type $nombreUsuario nombre de usuario del usuario
     * @param type $rol rol del usuario
     * @param type $cursos cursos del usuario en caso de ser un alumno
     */
    public function update($id, $nombre, $apellidos, $correo, $nombreUsuario, $rol, $cursos) {

        $per = new Persona();

        $per->setId($id);
        $per->setNombre($nombre);
        $per->setApellidos($apellidos);
        $per->setCorreo($correo);

        $usu = new Usuario();

        $usu->setNombreUsuario($nombreUsuario);
        $usu->setRol($rol);

        $per->setUsuario($usu);

        //Añadimos los cursos
        $per->setCursos($cursos);

        $this->model->update($per);

        header('Location: index.php?c=Persona');
    }

    /**
     * Método para eliminar un usuario
     * 
     * Recibe el id del usuario por una petición get
     */
    public function eliminar() {
        $this->model->delete($_REQUEST['id']);
        header('Location: index.php?c=Persona');
    }

    /**
     * Método utilizado para comprobar si un email es válido o ya esta siendo utilizado para la validación con ajax
     * 
     * Recibe el email por petición http. Si el correo electrónico es válido muestra true, si no es válido devuelve false
     */
    public function comprobarEmailAjax() {
        if (isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {
            $email = trim($_REQUEST['email']);
            $email = strip_tags($email);

            $valido = $this->model->comprobarEmail($email);

            //Si el correo electrónico es válido muestra true, si no es válido devuelve false
            if ($valido) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    /**
     * Método utilizado para comprobar si un nombre de usuario es válido o ya esta siendo utilizado, para la validación con ajax
     * 
     * Recibe el nombre de usuario por petición post. Si el nombre de usuario es válido muestra true, si no es válido devuelve false
     */
    public function comprobarNombreUsuarioAjax() {
        if (isset($_REQUEST['nombreUsuario']) && !empty($_REQUEST['nombreUsuario'])) {
            $nombreUsuario = trim($_REQUEST['nombreUsuario']);
            $nombreUsuario = strip_tags($nombreUsuario);

            $valido = $this->model->comprobarNombreUsuario($nombreUsuario);

            //Si el nombre de usuario es válido muestra true, si no es válido devuelve false
            if ($valido) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    /**
     * Método utilizado para comprobar si un email es válido o ya esta siendo utilizado
     * 
     * @param type $email email que queremos comprobar si existe
     * @return boolean Si el correo electrónico es válido devuelve true, si no es válido devuelve false
     */
    public function emailValido($email) {
        $valido = $this->model->comprobarEmail($email);

        //Si el correo electrónico es válido devuelve true, si no es válido devuelve false
        if ($valido) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Método utilizado para comprobar si un nombre de usuario es válido o ya esta siendo utilizado
     * 
     * @param type $nombreUsuario nombre de usuario que queremos comprobar si existe
     * @return boolean Si el nombre de usuario es válido devuelve true, si no es válido devuelve false
     */
    public function nombreUsuarioValido($nombreUsuario) {
        $valido = $this->model->comprobarNombreUsuario($nombreUsuario);

        //Si el nombre de usuario es válido devuelve true, si no es válido devuelve false
        if ($valido) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Método para actualizar la contraseña de un usuario
     * 
     * Recibe el id del usuario por una petición http. Carga el formulario de 
     * actualizar contraseña, lo válida y en caso de ser correcto llama al método
     * de personaDAO actualizarPassword
     */
    public function vistaNuevaPassword() {
        $errorPassword = '';
        $usu = new Usuario();

        //Comprobamos que se haya enviado el formulario para validarlo
        if (isset($_REQUEST["bEnviar"])) {
            if (empty($_POST['password'])) {
                $errorPassword = "El password es requerido";
            } else {
                $password = $this->utilidades->filtrarDatos($_POST['password']);

                //Comprobamos que la contraseña tenga como mínimo 8 caracteres
                if (strlen($password) < 8) {
                    $errorPassword = "La contraseña debe tener como mínimo 8 carácteres";
                } else {

                    $expPassword = "/^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/";

                    //Comprobamos que la contraseña tenga como mínimo una minúscula, una mayúscula y un número
                    if (preg_match($expPassword, $password) != 1) {
                        $errorPassword = "La contraseña debe tener como mínimo una minúscula, una mayúscula y un número";
                    }
                }
            }

            //Comprobamos que no exista ningun error
            if ($errorPassword == '') {
                $usu->setId($_REQUEST['id']);
                
                //Ciframos la contraseña 
                $passwordCifrada = password_hash($password, PASSWORD_DEFAULT);
                $usu->setPassword($passwordCifrada);

                //Actualizamos la contraseña del usuario
                $this->model->actualizarPassword($usu);

                header('Location: index.php?c=Persona');
            }
        }

        if (isset($_REQUEST['id'])) {
            //Obtenemos todos los datos de la persona junto a los datos de la tabla usuarios
            $datos = $this->model->obtenerDatosId($_REQUEST['id']);

            $usu->setId($datos->id);
            $usu->setNombreUsuario($datos->nombre_usuario);
        }

        require_once '../view/header.php';
        require_once '../view/personas/actualizarPassword.php';
        require_once '../view/footer.php';
    }

}
