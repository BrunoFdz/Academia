<?php
/**
 * Controlador de login
 */
class UsuarioController {

    private $model;
    private $utilidades;

    /**
     * Constructor de la clase
     * 
     * Instancia el modelo de usuario y la clase utilidades
     */
    public function __construct() {
        $this->model = new UsuarioDAO();
        $this->utilidades = new Utilidades();
    }

    /**
     * Método utilizado para el login de el usuario.
     * 
     * Recibe el nombre de usuario y la contraseña por petición http. En
     * caso de que coincidan crea ua sesión y establece el id y el rol
     */
    public function login() {
        $nombreUsuario = $this->utilidades->filtrarDatos($_POST['username']);
        $password = $this->utilidades->filtrarDatos($_POST['password']);

        //Comprobamos si el usuario y contraseña son correctos
        if ($this->model->comprobarLoginUsuario($nombreUsuario, $password)) {
            //Obtengo el id y el rol del usuario
            $usuarioDatos = $this->model->obtenerDatos($nombreUsuario);

            //Creamos la sesión y guardamos el id y el rol
            session_start();
            $_SESSION['idUsuario'] = $usuarioDatos->getId();
            $_SESSION['rol'] = $usuarioDatos->getRol();

            if ($usuarioDatos->getRol() == 'alumno') {
                header('Location: index.php?c=Curso&a=mostrarCursosAlumno&id=' . $usuarioDatos->getId());
            } elseif ($usuarioDatos->getRol() == 'profesor') {
                header('Location: index.php?c=Curso&a=mostrarCursosProfesor&id=' . $usuarioDatos->getId());
            } elseif ($usuarioDatos->getRol() == 'administrador') {
                header('Location: index.php?c=Persona');
            }
        } else {
            header("Location: login.php?error");
        }
    }

    /**
     * Método utilizado para el logout del usuario
     * 
     * Elimina los datos de la sesión y la destruye
     */
    public function logout() {              
        session_start();        
        // Destruir todas las variables de sesión.
        $_SESSION = array();
        // Destruir la sesión.
        session_destroy();
        
        header("location: login.php");
    }    

}
