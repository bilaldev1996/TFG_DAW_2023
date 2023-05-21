<?php

class CentroController
{
    public $view;
    public $gestionar;
    public $title;
    private $centro;

    private $ciclo;


    public function __construct()
    {
        $this->centro = new CentroEducativo(NULL, NULL, NULL, NULL, NULL, NULL);
        $this->ciclo = new CicloFormativo(NULL, NULL, NULL, NULL, NULL, NULL);
        $this->gestionar = new Gestionar();
    }

    public function accesoCentro()
    {
        if (isset($_SESSION['centro'])) {
            return $this->panelCentro();
        } else {
            $this->view = 'accesoCentro';
            $this->title = 'Iniciar Sesión';
        }
    }

    /* Iniciar sesion */
    public function logearCentro()
    {
        $password = $_POST['password'];
        $email = $_POST['email'];


        if (!empty($password) && !empty($email)) {
            $logeo = $this->centro->login($password, $email);
            if ($logeo) {
                return $this->panelCentro();
            }

            $this->accesoCentro();
            return false;
        }
    }

    /* Cerrar sesion */
    public function logout()
    {
        $this->centro->close();
        $this->accesoCentro();
    }

    public function enviarEmail()
    {
        $email = $_POST['email'];

        if ($this->centro->comprobarEmail($email)) {
            $this->view = 'accesoCentro';
            return 'email no-existe';
        }

        // Configuramos las cabeceras del correo
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: JobsNow <administrador@jobsnow.es>" . "\r\n";

        // Configuramos el asunto y el cuerpo del correo
        $subject = "Restablecer Password";
        $message = '
        <h2>Recuperar contraseña</h2>
        <p>Has solicitado recuperar tu contraseña. Por favor haz clic en el siguiente enlace para restablecerla:</p>
        <a href="http://jobsnow.es/index.php?controller=CentroController&action=restablecerContraseña">Restablecer contraseña</a>
        <p>Si no solicitaste recuperar tu contraseña, por favor ignora este mensaje.</p>
    ';

        // Enviamos el correo
        if (mail($email, $subject, $message, $headers)) {
            //echo "El correo se ha enviado correctamente";
            $this->view = 'accesoCentro';
            return 'enviado';
        } else {
            $this->view = 'accesoCentro';
            return 'no-enviado';
        }
    }

    public function restablecerContraseña()
    {
        $this->view = 'restablecerContraseñaCentro';
        $this->title = 'Restablecer Contraseña';
    }

    public function cambiarContraseña()
    {
        $pass = $_POST['password'];
        $pass_confirm = $_POST['password-confirm'];

        if (empty($pass) || empty($pass_confirm)) {
            return false;
        }

        if ($pass !== $pass_confirm) {
            //echo "Las contraseñas no coinciden";
            $this->view = 'restablecerContraseñaCentro';
            return false;
        }

        if (!$this->centro->cambiarContraseña($pass)) {
            $this->view = 'restablecerContraseñaCentro';
            return false;
        }

        $this->view = 'accesoCentro';


        return 'contraseña cambiada';
    }

    public function panelCentro()
    {
        if (isset($_SESSION['centro'])) {
            $this->view = 'panelCentro';
            $this->title = 'Panel Centro';
            return array(
                'centro' => $this->centro->getCentroById($_SESSION['centro'])
            );
        } else {
            return $this->accesoCentro();
        }
    }

    public function registrarCentro()
    {
        $this->view = 'registrarCentro';
        $this->title = 'Registrar Centro';
    }

    public function altaCentro()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Recoger los datos del formulario
            $nombre = $_POST["nombre"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $email = $_POST["email"];
            $password = $_POST["password"];


            //comprobar si el email existe
            if (!$this->centro->comprobarEmail($_POST['email'])) {
                $this->view = 'registrarCentro';
                return 'email existe';
            };

            $this->centro->altaCentro($nombre, $direccion, $telefono, $email, $password);


            $this->view = 'registrarCentro';
            return 'registrado';
        }
    }


    public function validarTitulaciones()
    {
        if (isset($_SESSION['centro'])) {
            $this->view = 'validarTitulaciones';
            $this->title = 'Validar Titulaciones';
            return array(
                'estudiantesCentro' => $this->centro->getEstudiantesPorCentro(),
                'ciclosCentro' => $this->ciclo->getCiclosCentro($_SESSION['centro']),
            );
        }
        return $this->accesoCentro();
    }

    /* Validar una titulación de un estudiante */
    public function validarTitulacion()
    {

        if (!isset($_GET['idEstudiante']) & !isset($_GET['idCiclo'])) {
            return $this->validarTitulaciones();
        }

        $idEstudiante = $_GET['idEstudiante'];
        $idCiclo = $_GET['idCiclo'];

        $this->centro->validarTitulacion($idEstudiante, $idCiclo);

        return $this->validarTitulaciones();
    }

    /* Validar la titulación de varios estudiantes a la vez */
    public function validarTitulacionesEstudiantes()
    {
        /* Recuperar los datos del cuerpo de la solicitud HTTP sin procesar y decodificarlos del
        formato JSON en una matriz asociativa de PHP. Los datos se envían a través de JS mediante fetch por el método POST. */
        $requestBody = file_get_contents('php://input');
        $data = json_decode($requestBody, true);

        if (!isset($data['estudiantes']) || !isset($data['ciclos'])) {
            return $this->validarTitulaciones();
        }

        $estudiantes = $data['estudiantes'];
        $ciclos = $data['ciclos'];

        // Iterar sobre los estudiantes y ciclos para validar cada uno
        foreach ($estudiantes as $index => $idEstudiante) {
            $idCiclo = $ciclos[$index];
            $this->centro->validarTitulacion($idEstudiante, $idCiclo);
        }
        return $this->validarTitulaciones();
    }

    /* Eliminar la titulación de un estudiante que no le corresponde */
    public function eliminarTitulacionEstudiante()
    {

        if (!isset($_GET['idTitulacion']) & !isset($_GET['idEstudiante'])) {
            return $this->validarTitulaciones();
        }

        $this->gestionar->eliminarTitulacionEstudiante($_GET['idEstudiante'], $_GET['idTitulacion']);
        return $this->validarTitulaciones();
    }




    /* Actualiza los datos del perfil de un centro */
    public function actualizarPerfil()
    {
        $this->centro->setNombre($_POST["nombre"]);
        $this->centro->setDireccion($_POST["direccion"]);
        $this->centro->setTelefono($_POST["telefono"]);

        if ($this->centro->comprobarEmail($_POST['email'])) {
            $this->centro->setEmail($_POST["email"]);
        }


        // Verificar si se proporcionó una contraseña
        if (isset($_POST["password"]) && !empty($_POST["password"])) {
            $password = $_POST["password"];
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->centro->setpassword($hashPassword);
        }

        return $this->panelCentro();
    }

    public function añadirCiclos()
    {
        $this->view = 'añadirCiclos';
        $this->title = 'Añadir Ciclos';
    }

    /* Esta función crea un nuevo ciclo formativo */
    public function añadirCiclo()
    {

        $this->ciclo->nuevoCiclo($_POST['nombre'], $_POST['nivel'], $_POST['familia'], $_SESSION['centro']);
        $this->view = 'añadirCiclos';
        return 'ciclo-añadido';
    }

    /* Devolver en una vista los ciclos que corresponden a un centro educativo */
    public function misCiclos()
    {
        if (isset($_SESSION['centro'])) {
            $this->view = 'misCiclos';
            $this->title = 'Mis Ciclos';
            return array(
                'misCiclos' => $this->ciclo->getCiclosCentro($_SESSION['centro']),
            );
        }

        return $this->accesoCentro();
    }

    /* Función para editar un ciclo formativo */
    public function editarCiclo()
    {
        if ($_POST['idCiclo']) {
            $this->ciclo->actualizarCiclo($_POST['idCiclo'], $_POST['nombre'], $_POST['nivel'], $_POST['familia']);
            return $this->misCiclos();
        }
        return $this->misCiclos();
    }

    /* Función para eliminar un ciclo formativo */
    public function eliminarCiclo()
    {

        $idCiclo = isset($_GET['idCiclo']) ? $_GET['idCiclo'] : null;

        if ($this->ciclo->eliminarCiclo($idCiclo)) {
            $this->view = 'misCiclos';
            return 'ciclo-eliminado';
        }
    }
}
