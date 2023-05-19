<?php

class EstudianteController
{
    public $view;
    public $title;
    public $estudiante;
    public $gestionar;


    public function __construct()
    {
        $this->estudiante = new Estudiante(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $this->gestionar = new Gestionar();
    }

    public function accesoEstudiante()
    {
        if (isset($_SESSION['estudiante'])) {
            return $this->panelEstudiante();
        } else {
            $this->view = 'accesoEstudiante';
            $this->title = 'Iniciar Sesión';
        }
    }


    /* Iniciar sesion */
    public function logearEstudiante()
    {
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';

        if (!empty($password) && !empty($email)) {
            $logeo = $this->estudiante->login($password, $email);

            if ($logeo) {
                return $this->panelEstudiante();
            }
        }

        $this->accesoEstudiante();
        return false;
    }

    /* Cerrar sesion */
    public function logout()
    {
        $this->estudiante->close();
        $this->accesoEstudiante();
    }



    public function registrarEstudiante()
    {
        $this->view = 'registrarEstudiante';
        $this->title = 'Registrar Estudiante';
    }



    public function altaEstudiante()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Recoger los datos del formulario
            $nombre = $_POST["nombre"];
            $apellido1 = $_POST["apellido1"];
            $apellido2 = $_POST["apellido2"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $estado = $_POST["estado"];
            $perfil = $_POST["perfil"];
            $telefono = $_POST["telefono"];




            //comprobar si el email existe
            if (!$this->estudiante->comprobarEmail($_POST['email'])) {
                $this->view = 'registrarEstudiante';
                return 'email existe';
            };

            /* Guardar imagen en el servidor */
            if (!file_exists('assets/images/Estudiante/')) {
                mkdir('assets/images/Estudiante/',  0777, true);
            }

            $tipo_imagen = $_FILES['imagen']['type']; // tipo imagen
            // Separamos el tipo MIME en un array
            $tipo_imagen = explode("/", $tipo_imagen);

            $extension = "." . $tipo_imagen[1];
            $carpeta_destino_imagen = 'assets/images/Estudiante/'; // ruta en la que se van a guardar las imágenes

            /* Guardar curriculum en el servidor */
            if (!file_exists('assets/cvs/')) {
                mkdir('assets/cvs/',  0777, true);
            }

            $carpeta_destino_cv = 'assets/cvs/'; // ruta en la que se van a guardar los cvs

            $lastId = $this->estudiante->altaEstudiante($nombre, $apellido1, $apellido2, $email, $password, '.pdf', $estado, $perfil, $extension, $telefono);

            // añadir enlaces redes sociales
            $facebook = $_POST["facebook"];
            $instagram = $_POST["instagram"];
            $linkedin = $_POST["linkedin"];
            $github = $_POST["github"];

            if ($facebook) $this->estudiante->añadirRedSocial('Facebook', $lastId, $facebook);
            if ($instagram) $this->estudiante->añadirRedSocial('Instagram', $lastId, $instagram);
            if ($linkedin) $this->estudiante->añadirRedSocial('Linkedin', $lastId, $linkedin);
            if ($github) $this->estudiante->añadirRedSocial('Github', $lastId, $github);

            move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino_imagen . $lastId . $extension);
            move_uploaded_file($_FILES['curriculum']['tmp_name'], $carpeta_destino_cv . $lastId . '.pdf');

            $this->view = 'registrarEstudiante';
            return 'registrado';
        }
    }

    public function enviarEmail()
    {
        $email = $_POST['email'];

        if ($this->estudiante->comprobarEmail($email)) {
            $this->view = 'accesoEstudiante';
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
        <a href="http://jobsnow.es/index.php?controller=EstudianteController&action=restablecerContraseña">Restablecer contraseña</a>
        <p>Si no solicitaste recuperar tu contraseña, por favor ignora este mensaje.</p>
    ';

        // Enviamos el correo
        if (mail($email, $subject, $message, $headers)) {
            //echo "El correo se ha enviado correctamente";
            $this->view = 'accesoEstudiante';
            return 'enviado';
        } else {
            $this->view = 'accesoEstudiante';
            return 'no-enviado';
        }
    }


    public function restablecerContraseña()
    {
        $this->view = 'restablecerContraseñaEstudiante';
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
            $this->view = 'restablecerContraseñaEstudiante';
            return false;
        }

        if (!$this->estudiante->cambiarContraseña($pass)) {
            $this->view = 'restablecerContraseñaEstudiante';
            return false;
        }

        $this->view = 'accesoEstudiante';


        return 'contraseña cambiada';
    }

    /* Página principal estudiante */
    public function panelEstudiante()
    {
        if (isset($_SESSION['estudiante'])) {
            $this->view = 'panelEstudiante';
            $this->title = 'Panel Estudiante';
            return array(
                'estudiante' => $this->estudiante->getEstudianteById($_SESSION['estudiante']),
                'ciclos' => $this->gestionar->getCiclosFormativos(),
                "misCiclos" => $this->estudiante->getCiclosEstudiante(),
                'misTitulaciones' => $this->estudiante->getTitulacionesEstudiante($_SESSION['estudiante']),
                'cicloCursando' => $this->estudiante->getCicloActual(),
                "centros" => $this->gestionar->getCentros(),
                'redesSociales' => $this->estudiante->redesSocialesEstudiante($_SESSION['estudiante'])
            );
        } else {
            return $this->accesoEstudiante();
        }
    }


    public function actualizarPerfil()
    {
        $this->estudiante->setNombre($_POST["nombre"]);
        $this->estudiante->setApellido1($_POST["apellido1"]);
        $this->estudiante->setApellido2($_POST["apellido2"]);


        // si el email existe en la base de datos, no lo cambia
        if ($this->estudiante->comprobarEmail($_POST['email'])) {
            $this->estudiante->setEmail($_POST["email"]);
        }

        $this->estudiante->setTelefono($_POST["telefono"]);

        if (isset($_POST["password"]) && !empty($_POST["password"])) {
            $password = $_POST["password"];
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->estudiante->setpassword($hashPassword);
        }

        $this->estudiante->setEstado($_POST["estado"]);
        $this->estudiante->setPerfil($_POST["perfil"]);

        // actualizar enlaces redes sociales
        $facebook = $_POST["facebook"];
        $instagram = $_POST["instagram"];
        $linkedin = $_POST["linkedin"];
        $github = $_POST["github"];

        if ($facebook) $this->estudiante->actualizarRedSocial('Facebook', $_SESSION['estudiante'], $facebook);
        if ($instagram) $this->estudiante->actualizarRedSocial('Instagram', $_SESSION['estudiante'], $instagram);
        if ($linkedin) $this->estudiante->actualizarRedSocial('Linkedin', $_SESSION['estudiante'], $linkedin);
        if ($github) $this->estudiante->actualizarRedSocial('Github', $_SESSION['estudiante'], $github);

        return $this->panelEstudiante();
    }

    public function cambiarCurriculum()
    {
        /* Guardar curriculum en el servidor */
        if (!file_exists('assets/cvs/')) {
            mkdir('assets/cvs/',  0777, true);
        }

        $carpeta_destino_cv = 'assets/cvs/'; // ruta en la que se van a guardar los cvs

        $idEstudiante = $_SESSION['estudiante'];
        $cv = $idEstudiante . '.pdf';

        $this->estudiante->setCurriculum($cv);

        move_uploaded_file($_FILES['curriculum']['tmp_name'], $carpeta_destino_cv . $idEstudiante . '.pdf');

        header("Location: index.php?controller=EstudianteController&action=accesoEstudiante");
        exit();
    }

    public function cambiarImagen()
    {

        $idEstudiante = $_SESSION['estudiante'];

        if (!file_exists('assets/images/Estudiante/')) {
            mkdir('assets/images/Estudiante/',  0777, true);
        }

        $tipo_imagen = $_FILES['imagen']['type'];
        $tipo_imagen = explode("/", $tipo_imagen);

        $extension = "." . $tipo_imagen[1];
        $carpeta_destino_imagen = 'assets/images/Estudiante/';

        $nueva_imagen = $idEstudiante . $extension;

        $this->estudiante->setImagen($nueva_imagen);

        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino_imagen . $idEstudiante . $extension);


        header("Location: index.php?controller=EstudianteController&action=accesoEstudiante");
        exit();
    }

    public function darseBajaEstudiante()
    {

        /* Eliminar imagen y curriculum del servidor local */
        $rutaImagen = "assets/images/Estudiante/" . $_SESSION['estudiante'];
        $extensiones = array(".png", ".jpg", ".jpeg", ".gif");
        foreach ($extensiones as $extension) {
            if (file_exists($rutaImagen . $extension)) {
                unlink($rutaImagen . $extension);
                break;
            }
        }
        $rutaCv = "assets/cvs/" . $_SESSION['estudiante'] . '.pdf';
        if (file_exists($rutaCv)) {
            unlink($rutaCv);
        }

        $this->estudiante->darseBajaEstudiante($_SESSION['estudiante']);
    }

    public function misOfertas()
    {
        if (isset($_SESSION['estudiante'])) {
            $this->view = 'misOfertas';
            $this->title = 'Mis Candidaturas';
            return array(
                "estudiante" => $this->estudiante->getEstudianteById($_SESSION['estudiante']),
                "misOfertas" => $this->estudiante->misOfertas(),
            );
        }

        return $this->accesoEstudiante();
    }

    public function eliminarCandidatura()
    {
        $idOferta = $_GET['idOferta'];

        $numInscritos = $this->gestionar->getNumInscritos($idOferta);

        $numInscritos--;

        $this->gestionar->setNumInscritos($idOferta, $numInscritos);
        $this->estudiante->eliminarCandidatura($idOferta);
        return $this->misOfertas();
    }

    public function añadirTitulacion()
    {

        if (!isset($_POST['anioCurso'])) {

            // marcar completa un curso que se esta cursando
            $titulacionesExistentes = $this->estudiante->getTitulacionesExistentes();
            if (in_array($_GET['idCiclo'], $titulacionesExistentes)) {
                //echo 'titulacion-existente';
                return $this->panelEstudiante();
            }

            // Añadir la titulacion a la relacion estudiante - titulacion
            $idTitulacion = $this->estudiante->añadirTitulacion($_GET['idCiclo'], date('Y'));
            $this->estudiante->añadirEstudianteTitulacion($idTitulacion);
            $this->estudiante->setIdCiclo(null); // borrar ciclo cursando
            return $this->panelEstudiante();
        }

        $anioCurso = $_POST['anioCurso'];
        $idCiclo = $_POST['ciclo'];

        $titulacionesExistentes = $this->estudiante->getTitulacionesExistentes();
        if (in_array($idCiclo, $titulacionesExistentes)) {
            //echo 'titulacion-existente';
            return $this->panelEstudiante();
        }

        // Añadir la titulacion a la relacion estudiante - titulacion
        $idTitulacion = $this->estudiante->añadirTitulacion($idCiclo, $anioCurso);
        $this->estudiante->añadirEstudianteTitulacion($idTitulacion);

        return $this->panelEstudiante();
    }

    public function añadirCurso()
    {
        $idCiclo = $_POST['ciclo'];

        $this->estudiante->setCampo($idCiclo, 'idCiclo');
        return $this->panelEstudiante();
    }
}
