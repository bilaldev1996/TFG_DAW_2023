<?php
class Estudiante
{

    // Propiedades de la clase Estudiante
    private $id;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $email;
    private $password;
    private $curriculum;
    private $estado;
    private $perfil;
    private $imagen;
    private $telefono;

    private $conection;

    // Constructor de la clase Estudiante
    public function __construct($id, $nombre, $apellido1, $apellido2, $email, $password, $curriculum, $estado, $perfil, $imagen, $telefono)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->email = $email;
        $this->password = $password;
        $this->curriculum = $curriculum;
        $this->estado = $estado;
        $this->perfil = $perfil;
        $this->imagen = $imagen;
        $this->telefono = $telefono;
        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = Db::getInstance();
        $this->conection = $dbObj->connection;
    }


    // Métodos Getter y Setter de la clase Estudiante
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        $this->setCampo($nombre, 'nombre');
    }

    public function getApellido1()
    {
        return $this->apellido1;
    }

    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
        $this->setCampo($apellido1, 'apellido1');
    }

    public function getApellido2()
    {
        return $this->apellido2;
    }

    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
        $this->setCampo($apellido2, 'apellido2');
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->setCampo($email, 'email');
    }

    public function getpassword()
    {
        return $this->password;
    }

    public function setpassword($password)
    {
        $this->password = $password;
        $this->setCampo($password, 'password');
    }

    public function getCurriculum()
    {
        return $this->curriculum;
    }

    public function setCurriculum($curriculum)
    {
        $this->curriculum = $curriculum;
        $this->setCampo($curriculum, 'curriculum');
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
        $this->setCampo($estado, 'estado');
    }

    public function getPerfil()
    {
        return $this->perfil;
    }

    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
        $this->setCampo($perfil, 'perfil');
    }

    public function getImagen()
    {
        $sql = "SELECT imagen FROM estudiante WHERE idEstudiante = " . $this->id;
        $resultado = mysqli_query($this->conection, $sql);

        while ($fila = mysqli_fetch_array($resultado)) {
            $img = $fila['imagen'];
        }

        return $img;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
        $this->setCampo($imagen, 'imagen');
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        $this->setCampo($telefono, 'telefono');
    }

    public function setIdCiclo($idCiclo)
    {
        $this->setCampo($idCiclo, 'idCiclo');
    }

    /**
     * Esta función de PHP actualiza un campo específico en una tabla de base de datos para una
     * identificación de estudiante determinada.
     * 
     * @param valor El valor que se establecerá en el campo especificado de la tabla "estudiante".
     * @param campo El nombre de la columna en la tabla "estudiante" que necesita ser actualizada.
     * 
     * @return un valor booleano, verdadero si la consulta de actualización se ejecutó correctamente y
     * falso si hubo un error.
     */
    public function setCampo($valor, $campo)
    {
        $sql = "UPDATE estudiante SET $campo = ? WHERE idEstudiante = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("si", $valor, $_SESSION['estudiante']);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al actualizar el campo: " . $stmt->error;
            return false;
        }
    }


    public function eliminarEstudiante($idEstudiante)
    {
        $sql = "DELETE FROM estudiante WHERE idEstudiante = $idEstudiante";
        $result = $this->conection->query($sql);

        if ($result) {
            return true;
        } else {
            throw new Exception("No se pudo eliminar el estudiante");
        }
    }

    /* Crear nuevo estudiante */
    public function altaEstudiante($nombre, $apellido1, $apellido2, $email, $password, $cv, $estado, $perfil, $imagen, $telefono)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // preparar la consulta con parámetros marcados con signos de interrogación
        $sql = "INSERT INTO estudiante (nombre, apellido1, apellido2, email, password, curriculum, estado, perfil, imagen,telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $this->conection->prepare($sql);


        // asociar los valores a los parámetros de la consulta
        $stmt->bind_param("ssssssssss", $nombre, $apellido1, $apellido2, $email, $hashPassword, $cv, $estado, $perfil, $imagen, $telefono);



        if ($stmt->execute()) {

            /* Recoger ultimo id insertado */
            $lastId = mysqli_insert_id($this->conection);

            $nombre_img = $lastId . $imagen;
            $nombre_cv = $lastId . $cv;

            // preparar la consulta para actualizar los campos de imagen y curriculum
            $sql = "UPDATE estudiante SET imagen = ?, curriculum = ? WHERE idEstudiante = ?";
            $stmt = $this->conection->prepare($sql);



            // asociar los valores a los parámetros de la consulta
            $stmt->bind_param("ssi", $nombre_img, $nombre_cv, $lastId);
            $stmt->execute();

            return $lastId;
        } else {
            return false;
        }
    }

    public function añadirRedSocial($nombre, $idEstudiante, $enlace)
    {
        $sql = "INSERT INTO redessociales (nombre_red,id_estudiante,enlace_red) VALUES (?,?,?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("sis", $nombre, $idEstudiante, $enlace);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizarRedSocial($nombre, $idEstudiante, $enlace)
    {
        // 1. Consulta para comprobar si el estudiante ya tiene una red social con ese nombre
        $sql = "SELECT * FROM redessociales WHERE id_estudiante = ? AND nombre_red = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("is", $idEstudiante, $nombre);
        $stmt->execute();
        $result = $stmt->get_result();

        // 2. Si la consulta devuelve un resultado, actualiza el enlace de la red social existente
        if ($result->num_rows > 0) {
            $sql = "UPDATE redessociales SET enlace_red = ? WHERE id_estudiante = ? AND nombre_red = ?";
            $stmt = $this->conection->prepare($sql);
            $stmt->bind_param("sis", $enlace, $idEstudiante, $nombre);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        // 3. Si la consulta no devuelve resultados, inserta una nueva fila en la tabla de redessociales
        else {
            $sql = "INSERT INTO redessociales (nombre_red, enlace_red, id_estudiante) VALUES (?, ?, ?)";
            $stmt = $this->conection->prepare($sql);
            $stmt->bind_param("ssi", $nombre, $enlace, $idEstudiante);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }




    /* Inicio sesion estudiante */
    public function login($password, $email)
    {

        $sql = "SELECT * FROM `estudiante` WHERE `email` = '$email'";
        $result = $this->conection->query($sql);
        if ($result->num_rows < 1) return false;
        $row = $result->fetch_assoc();


        if (password_verify($password, $row['password'])) {
            $_SESSION['estudiante'] = $row['idEstudiante'];
            return $row;
        } else {
            return false;
        }
    }

    public function close()
    {
        $_SESSION['estudiante'] = NULL;
        unset($_SESSION['estudiante']);
    }

    public function cambiarContraseña($nuevaContraseña)
    {
        $hashContraseña = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
        $sql = "UPDATE estudiante SET password = '$hashContraseña'";

        if ($this->conection->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function comprobarEmail($email)
    {
        // Consulta a la base de datos
        $sql = "SELECT * FROM estudiante WHERE email = '$email'";
        $resultado = $this->conection->query($sql);

        /* Si ya existe un email */
        if ($resultado->num_rows > 0) return false;

        return true;
    }

    /* Devolver estudiante por id */
    public function getEstudianteById($idEstudiante)
    {
        $stmt = $this->conection->prepare("SELECT * FROM estudiante WHERE idEstudiante = ?");
        $stmt->bind_param("i", $idEstudiante);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows < 1) return false;
        $row = $resultado->fetch_assoc();


        return $row;
    }

    public function darseBajaEstudiante($idEstudiante)
    {
        $sql = "DELETE FROM estudiante WHERE idEstudiante = ?";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("i", $idEstudiante);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function inscrito($idOferta)
    {
        $sql = "SELECT * FROM estudiante_oferta WHERE idEstudiante = ? AND idOferta = ?";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("ii", $_SESSION['estudiante'], $idOferta);

        $stmt->execute();

        $result = $stmt->get_result();
        $num_rows = $result->num_rows;
        $row = $result->fetch_assoc();


        if ($num_rows > 0) {
            return $row;
        } else {
            return false;
        }
    }

    /* Devolver todas las ofertas a las que me he inscrito */
    public function misOfertas()
    {
        $sql = "SELECT * FROM estudiante_oferta WHERE idEstudiante = ? ORDER BY fechaEnvio DESC";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("i", $_SESSION['estudiante']);

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows < 1) return false;

        $rows = array();

        while ($row = $resultado->fetch_assoc()) {
            $rows[] = $row;
        }


        return $rows;
    }

    public function eliminarCandidatura($idOferta)
    {
        $sql = "DELETE FROM estudiante_oferta WHERE idEstudiante = ? AND idOferta = ?";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("ii", $_SESSION['estudiante'], $idOferta);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /* añadir una titulacion a un estudiante */
    public function añadirEstudianteTitulacion($idTitulacion)
    {
        $idEstudiante = $_SESSION['estudiante'];

        $stmt = $this->conection->prepare("INSERT INTO estudiante_titulacion (idEstudiante, idTitulacion) VALUES (?, ?)");
        $stmt->bind_param("ii", $idEstudiante, $idTitulacion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function añadirTitulacion($idCiclo, $anioCurso)
    {
        $stmt = $this->conection->prepare("INSERT INTO titulacion (verificado, anio_curso, fecha_verificacion, idCiclo) VALUES (?, ?, ?, ?)");
        $verificado = 0;
        $fechaVerificacion = NULL;
        $stmt->bind_param("isii", $verificado, $anioCurso, $fechaVerificacion, $idCiclo);

        if ($stmt->execute()) {
            $ultimoId = mysqli_insert_id($this->conection);
            return $ultimoId;
        } else {
            return false;
        }
    }




    /* Devolver los ciclos obtenidos por un estudiante */
    public function getCiclosEstudiante()
    {
        $sql = "SELECT c.nombreCiclo FROM cicloformativo c 
                JOIN titulacion t ON c.idCiclo = t.idCiclo 
                JOIN estudiante_titulacion et ON t.idTitulacion = et.idTitulacion 
                WHERE et.idEstudiante = ?";

        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $_SESSION['estudiante']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Obtener los nombres de los ciclos en un array
        $ciclos = array();
        while ($row = $result->fetch_assoc()) {
            $ciclos[] = $row['nombreCiclo'];
        }

        return $ciclos;
    }

    public function getTitulacionesExistentes()
    {
        $sql = "SELECT t.idCiclo FROM titulacion t JOIN estudiante_titulacion et ON t.idTitulacion = et.idTitulacion WHERE et.idEstudiante = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $_SESSION['estudiante']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Almacenar los ID de ciclo existentes en un array
        $titulaciones = array();
        while ($row = $result->fetch_assoc()) {
            $titulaciones[] = $row['idCiclo'];
        }

        return $titulaciones;
    }

    public function getTitulacionesEstudiante($idEstudiante)
    {
        $sql = "SELECT t.idTitulacion, t.anio_curso, t.verificado,t.fecha_verificacion, t.idCiclo, c.nombreCiclo,c.nivel
        FROM titulacion t
        JOIN cicloformativo c ON t.idCiclo = c.idCiclo
        JOIN estudiante_titulacion et ON t.idTitulacion = et.idTitulacion 
        WHERE et.idEstudiante = ?
        ";

        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idEstudiante);
        $stmt->execute();
        $result = $stmt->get_result();

        // Obtener los nombres de los titulaciones en un array
        $titulaciones = array();
        while ($row = $result->fetch_assoc()) {
            $titulaciones[] = $row;
        }

        return $titulaciones;
    }

    // Devolver el ciclo que está cursando un estudiante
    public function getCicloActual()
    {
        $sql  = "SELECT *
        FROM cicloformativo cf
        JOIN estudiante e
        ON e.idCiclo = cf.idCiclo
        WHERE e.idEstudiante = ?";

        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $_SESSION['estudiante']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows < 1) return false;
        $row = $result->fetch_assoc();

        return $row;
    }

    public function redesSocialesEstudiante($idEstudiante)
    {
        $sql = "SELECT * FROM redessociales WHERE id_estudiante = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idEstudiante);
        $stmt->execute();
        $result = $stmt->get_result();

        $redes = array();
        while ($row = $result->fetch_assoc()) {
            $redes[] = $row;
        }

        return $redes;
    }
}
