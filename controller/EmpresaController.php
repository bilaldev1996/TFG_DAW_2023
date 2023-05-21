<?php


class EmpresaController
{
    public $view;
    public $gestionar;
    public $title;
    public $empresa;
    public $oferta;
    public $estudiante;


    public function __construct()
    {
        $this->empresa = new Empresa(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $this->oferta = new Oferta(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $this->gestionar = new Gestionar();
    }

    public function accesoEmpresa()
    {
        if (isset($_SESSION['empresa'])) {
            return $this->panelEmpresa();
        } else {
            $this->view = 'accesoEmpresa';
            $this->title = 'Iniciar Sesión';
        }
    }


    /* Iniciar sesion */
    public function logearEmpresa()
    {
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';

        if (!empty($password) && !empty($email)) {
            $logeo = $this->empresa->login($password, $email);

            if ($logeo) {
                return $this->panelEmpresa();
            }
        }

        $this->accesoEmpresa();
        return false;
    }

    /* Cerrar sesion */
    public function logout()
    {
        $this->empresa->close();
        $this->accesoEmpresa();
    }

    public function registrarEmpresa()
    {
        $this->view = 'registrarEmpresa';
        $this->title = 'Registrar Empresa';
    }

    public function altaEmpresa()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Recoger los datos del formulario
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $cif = $_POST["cif"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $sitioWeb = $_POST["sitioWeb"];
            $direccion = $_POST["direccion"];


            //comprobar si el email existe
            if (!$this->empresa->comprobarEmail($_POST['email'])) {
                $this->view = 'registrarEmpresa';
                return 'email existe';
            };

            /* Guardar imagen en el servidor */
            if (!file_exists('assets/logos/Empresa/')) {
                mkdir('assets/logos/Empresa/',  0777, true);
            }

            $tipo_imagen = $_FILES['imagen']['type']; // tipo imagen
            // Separamos el tipo MIME en un array
            $tipo_imagen = explode("/", $tipo_imagen);

            $extension = "." . $tipo_imagen[1];
            $carpeta_destino_imagen = 'assets/logos/Empresa/'; // ruta en la que se van a guardar las imágenes


            $lastId = $this->empresa->altaEmpresa($nombre, $email, $password, $descripcion, $extension, $sitioWeb, $cif, $direccion);

            move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino_imagen . $lastId . $extension);

            $this->view = 'registrarEmpresa';
            $cuerpo = 'Validar la empresa ' . $nombre;
            $this->enviarCorreo($email, $cuerpo, 'Validar empresa');
            return 'registrado';
        }
    }

    function enviarCorreo($email, $cuerpo, $asunto)
    {
        // Headers del correo
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: " . $email . "\r\n";
        $headers .= "Reply-To: JobsNow <" . 'administrador@jobsnow.es' . ">\r\n";

        // Enviamos el correo usando la función mail()
        if (mail('administrador@jobsnow.es', $asunto, $cuerpo, $headers)) {
            return true;
        } else {
            return false;
        }
    }



    public function enviarEmail()
    {
        $email = $_POST['email'];

        if ($this->empresa->comprobarEmail($email)) {
            $this->view = 'accesoEmpresa';
            return 'email no-existe';
        }

        $asunto = 'Restablecer Password';
        $cuerpo = '
            <h2>Recuperar contraseña</h2>
            <p>Has solicitado recuperar tu contraseña. Por favor haz clic en el siguiente enlace para restablecerla:</p>
            <a href="http://jobsnow.es/index.php?controller=EmpresaController&action=restablecerContraseña">Restablecer contraseña</a>
            <p>Si no solicitaste recuperar tu contraseña, por favor ignora este mensaje.</p>
        ';
        // Headers del correo
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: JobsNow <" . 'administrador@jobsnow.es' . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";

        // Enviamos el correo usando la función mail()
        if (mail($email, $asunto, $cuerpo, $headers)) {
            $this->view = 'accesoEmpresa';
            return 'enviado';
        }
    }

    public function restablecerContraseña()
    {
        $this->view = 'restablecerContraseñaEmpresa';
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
            $this->view = 'restablecerContraseñaEmpresa';
            return false;
        }

        if (!$this->empresa->cambiarContraseña($pass)) {
            $this->view = 'restablecerContraseñaEmpresa';
            return false;
        }

        $this->view = 'accesoEmpresa';


        return 'contraseña cambiada';
    }

    /* Cambiar logo de la empresa */
    public function cambiarImagen()
    {

        $idEmpresa = $_SESSION['empresa'];

        if (!file_exists('assets/images/Empresa/')) {
            mkdir('assets/images/Empresa/',  0777, true);
        }

        $tipo_imagen = $_FILES['imagen']['type'];
        $tipo_imagen = explode("/", $tipo_imagen);

        $extension = "." . $tipo_imagen[1];
        $carpeta_destino_imagen = 'assets/logos/Empresa/';

        $nueva_imagen = $idEmpresa . $extension;

        $this->empresa->setLogo($nueva_imagen);

        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino_imagen . $idEmpresa . $extension);


        header("Location: index.php?controller=EmpresaController&action=panelEmpresa");
        exit();
    }


    public function panelEmpresa()
    {
        if (isset($_SESSION['empresa'])) {
            $this->view = 'panelEmpresa';
            $this->title = 'Panel Empresa';
            return array(
                'empresa' => $this->empresa->getEmpresaById($_SESSION['empresa'])
            );
        } else {
            return $this->accesoEmpresa();
        }
    }

    public function actualizarPerfil()
    {
        $this->empresa->setNombre($_POST["nombre"]);
        $this->empresa->setDireccion($_POST["direccion"]);
        $this->empresa->setDescripcion($_POST["descripcion"]);
        $this->empresa->setCIF($_POST["cif"]);
        $this->empresa->setSitioWeb($_POST["sitioWeb"]);


        if ($this->empresa->comprobarEmail($_POST['email'])) {
            $this->empresa->setEmail($_POST["email"]);
        }


        // Verificar si se proporcionó una contraseña
        if (isset($_POST["password"]) && !empty($_POST["password"])) {
            $password = $_POST["password"];
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->empresa->setpassword($hashPassword);
        }

        return $this->panelEmpresa();
    }


    public function publicarOferta()
    {
        if (isset($_SESSION['empresa'])) {
            $this->view = 'publicarOferta';
            $this->title = 'Publicar Oferta';
            return $this->empresa->getEmpresaById($_SESSION['empresa']);
        }

        return $this->accesoEmpresa();
    }


    /* Publicar oferta de empleo */
    public function publicarOfertaEmpleo()
    {


        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $nombre = $_POST['nombre'];
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $fechaVencimiento = $_POST['fechaVencimiento'];
            $fechaPublicacion = $_POST['fechaPublicacion'];
            $requisitos = $_POST['requisitos'];
            $numeroVacantes = $_POST['numVacantes'];
            $salario = $_POST['salario'];

            $numeroInscritos = 0;
            $idEmpresa = $_SESSION['empresa'];

            $this->oferta->publicarOfertaEmpleo($nombre, $titulo, $descripcion, $fechaVencimiento, $fechaPublicacion, $requisitos, $numeroVacantes, $salario, $numeroInscritos, $idEmpresa);

            return $this->ofertasEmpresa();
        }
    }

    /* Mostrar todas las ofertas que tenga una empresa */
    public function ofertasEmpresa()
    {
        if (isset($_SESSION['empresa'])) {
            $this->view = 'ofertasEmpresa';
            $this->title = 'Mis Ofertas';
            return array(
                'ofertasEmpresa' => $this->empresa->getOfertasEmpresa(),
                'empresa' => $this->empresa->getEmpresaById($_SESSION['empresa'])
            );
        }

        return $this->accesoEmpresa();
    }

    /* Ver una oferta concreta de una empresa */
    public function verOferta()
    {
        if (isset($_SESSION['empresa'])) {
            $this->view = 'verOfertaEmpresa';
            $this->title = 'Ver Oferta';
            return array(
                'oferta' => $this->gestionar->getOfertaById($_GET['idOferta']),
                'empresa' => $this->empresa->getEmpresaById($_SESSION['empresa'])
            );
        }

        return $this->accesoEmpresa();
    }

    /* Editar una oferta de una empresa */
    public function editarOferta()
    {
        if (isset($_SESSION['empresa'])) {
            $this->view = 'editarOferta';
            $this->title = 'Editar Oferta';
            return array(
                'oferta' => $this->gestionar->getOfertaById($_GET['idOferta']),
                'empresa' => $this->empresa->getEmpresaById($_SESSION['empresa'])
            );
        }
        return $this->accesoEmpresa();
    }

    public function actualizarOferta()
    {
        $idOferta = $_GET['idOferta'];
        $this->oferta->setTitulo($_POST["titulo"], $idOferta);

        $this->oferta->setRequisitos($_POST["requisitos"], $idOferta);
        $this->oferta->setDescripcion($_POST["descripcion"], $idOferta);
        $this->oferta->setFechaPublicacion($_POST["fechaPublicacion"], $idOferta);
        $this->oferta->setFechaVencimiento($_POST["fechaVencimiento"], $idOferta);
        $this->oferta->setNumVacantes($_POST["numVacantes"], $idOferta);
        $this->oferta->setSalario($_POST["salario"], $idOferta);

        $this->view = 'editarOferta';
        return $this->verOferta();
    }

    public function eliminarOferta()
    {
        $this->oferta->eliminarOferta($_GET['idOferta']);
    }

    /*  */
    /**
     * Esta función devuelve información sobre los estudiantes que se han postulado a una oferta de
     * trabajo, incluido su estado y la fecha en que se envió la solicitud.
     * Devuelve todos los estudiantes en sus diferentes estados.
     */
    public function estudiantesInscritos()
    {
        if (isset($_SESSION['empresa'])) {
            $this->view = 'estudiantesInscritos';
            return array(
                'estudiantesInscritos' => $this->oferta->estudiantesInscritos($_GET['idOferta']),
                'estudiantesRechazados' => $this->oferta->estadoCandidaturaEstudiante($_GET['idOferta'], 'Rechazado'),
                'estudiantesProceso' => $this->oferta->estadoCandidaturaEstudiante($_GET['idOferta'], 'En Proceso'),
                'estudiantesContratados' => $this->oferta->estadoCandidaturaEstudiante($_GET['idOferta'], 'Contratado'),
                'oferta' => $this->oferta->getOfertaById($_GET['idOferta']),
                'empresa' => $this->empresa->getEmpresaById($_SESSION['empresa']),
                'fechaEnvio' => $this->oferta->getFechaEnvio($_GET['idOferta'])
            );
        }

        return $this->accesoEmpresa();
    }

    public function descartarEstudiante()
    {
        $this->oferta->cambiarCandidaturaEstudiante($_GET['idEstudiante'], $_GET['idOferta'], 'Rechazado');
        return $this->estudiantesInscritos();
    }
    public function contratarEstudiante()
    {
        $this->oferta->cambiarCandidaturaEstudiante($_GET['idEstudiante'], $_GET['idOferta'], 'Contratado');
        return $this->estudiantesInscritos();
    }
    public function procesoEstudiante()
    {
        $this->oferta->cambiarCandidaturaEstudiante($_GET['idEstudiante'], $_GET['idOferta'], 'En Proceso');
        return $this->estudiantesInscritos();
    }


    public function eliminarCuenta()
    {

        $rutaImagen = "assets/logos/Empresa/" . $_SESSION['empresa'];
        $extensiones = array(".png", ".jpg", ".jpeg", ".gif");
        foreach ($extensiones as $extension) {
            if (file_exists($rutaImagen . $extension)) {
                unlink($rutaImagen . $extension);
                break;
            }
        }

        $this->empresa->eliminarCuenta($_SESSION['empresa']);
    }

    /* mostrar todos los estudiantes que tengan un perfil público */
    public function verEstudiantes()
    {
        if (isset($_SESSION['empresa'])) {
            $this->view = 'verEstudiantes';
            $this->title = 'Estudiantes';
            return array(
                'empresa' => $this->empresa->getEmpresaById($_SESSION['empresa']),
                'estudiantes' => $this->gestionar->getEstudiantesPúblicos(),
                'ciclosFormativos' => $this->gestionar->getCiclosFormativos()
            );
        }

        return $this->accesoEmpresa();
    }
}
