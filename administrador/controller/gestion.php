<?php

class gestion
{
    public $view;
    public $gestionar;
    public $title;

    public $centro;
    public $empresa;


    public function __construct()
    {
        $this->view = 'Login';
        $this->gestionar = new Gestionar();
        $this->centro = new CentroEducativo(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    public function login()
    {
        if (isset($_SESSION['admin'])) {
            return $this->verPanel();
        } else {
            $this->view = 'login';
            $this->title = 'Inicio de Sesión';
        }
    }


    public function logearAdmin()
    {
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';

        if (!empty($password) && !empty($email)) {
            $logeo = $this->gestionar->login($password, $email);

            if ($logeo) {
                $this->verPanel();
                header('Location: index.php');
                return $logeo;
            }
        }

        $this->login();
        return false;
    }


    public function verPanel()
    {
        if (isset($_SESSION['admin'])) {
            $this->view = 'dashboard';
            $this->title = 'Dashboard';
            $numero_estudiantes = $this->gestionar->getNumeroRegistros('estudiante');
            $numero_empresas = $this->gestionar->getNumeroRegistros('empresa');
            $numero_centros = $this->gestionar->getNumeroRegistros('centroeducativo');
            $numero_ofertas = $this->gestionar->getNumeroRegistros('ofertaempleo');
            return [$numero_estudiantes, $numero_empresas, $numero_centros, $numero_ofertas];
        } else {
            $this->login();
        }
    }

    public function logout()
    {
        $this->gestionar->close();
        $this->login();
    }


    public function enviarEmail()
    {
        $email = $_POST['email'];

        if ($email !== 'administrador@jobsnow.es') {
            $this->view = 'login';
            return;
        };

        $asunto = 'Restablecer Password';
        $cuerpo = '
            <h2>Recuperar contraseña</h2>
            <p>Has solicitado recuperar tu contraseña. Por favor haz clic en el siguiente enlace para restablecerla:</p>
            <a href="http://jobsnow.es/administrador/index.php?action=restablecerContraseña">Restablecer contraseña</a>
            <p>Si no solicitaste recuperar tu contraseña, por favor ignora este mensaje.</p>
        ';
        // Headers del correo
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: JobsNow <" . 'administrador@jobsnow.es' . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";

        // Enviamos el correo usando la función mail()
        if (mail($email, $asunto, $cuerpo, $headers)) {
            $this->view = 'login';
            return 'enviado';
        }
    }


    public function restablecerContraseña()
    {
        $this->view = 'restablecerContraseña';
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
            $this->view = 'restablecerContraseña';
            return false;
        }

        if (!$this->gestionar->cambiarContraseña($pass)) {
            $this->view = 'restablecerContraseña';
            return false;
        }

        $this->view = 'login';


        return 'contraseña cambiada';
    }

    public function gestionarEstudiantes()
    {
        $this->view = 'gestionarEstudiantes';
        return $this->gestionar->getEstudiantes();
    }

    public function gestionarEmpresas()
    {
        $this->view = 'gestionarEmpresas';
        return $this->gestionar->getEmpresas();
    }

    public function gestionarCentros()
    {
        $this->view = 'gestionarCentros';
        return $this->gestionar->getCentrosEducativos();
    }

    public function gestionarOfertas()
    {
        $this->view = 'gestionarOfertas';
        return $this->gestionar->getOfertas();
    }

    public function eliminarEstudiante()
    {
        if (isset($_GET['id'])) {
            $idEstudiante = $_GET['id'];
            $tabla = 'estudiante';
            $campo = 'idEstudiante';
            $this->gestionar->eliminarRegistro($idEstudiante, $tabla, $campo);
        }
    }

    public function eliminarEmpresa()
    {
        if (isset($_GET['id'])) {
            $idEmpresa = $_GET['id'];
            $tabla = 'empresa';
            $campo = 'idEmpresa';
            $this->gestionar->eliminarRegistro($idEmpresa, $tabla, $campo);
        }
    }

    public function eliminarCentro()
    {
        if (isset($_GET['id'])) {
            $idCentro = $_GET['id'];
            $tabla = 'centroeducativo';
            $campo = 'idCentro';
            $this->gestionar->eliminarRegistro($idCentro, $tabla, $campo);
        }
    }

    public function eliminarOferta()
    {
        if (isset($_GET['id'])) {
            $idOferta = $_GET['id'];
            $tabla = 'ofertaempleo';
            $campo = 'idOferta';
            $this->gestionar->eliminarRegistro($idOferta, $tabla, $campo);
        }
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
                $this->gestionarCentros();
                return 'email-existe';
            };

            $this->centro->altaCentro($nombre, $direccion, $telefono, $email, $password);


            $this->gestionarCentros();
            return "centro-añadido";
        }
    }

    public function verificarEmpresa()
    {
        $idEmpresa = $_GET['idEmpresa'];
        $email = $_GET['email'];

        $this->gestionar->verificarEmpresa($idEmpresa, 1);

        $cuerpo = 'Ya puedes iniciar sesión ' . '<a href="jobsnow.es/index.php?controller=EmpresaController&action=accesoEmpresa" class="text-blue-500" >InicarSesión</a>';
        $asunto = 'Cuenta Validada';

        // Headers del correo
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: JobsNow <" . 'administrador@jobsnow.es' . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";

        // Enviamos el correo usando la función mail()
        if (mail($email, $asunto, $cuerpo, $headers)) {
            return $this->gestionarEmpresas();
        }
    }
}
