<?php
class CentroEducativo
{
    private $idCentro;
    private $nombre;
    private $direccion;
    private $email;
    private $telefono;
    private $password;

    private $conection;

    public function __construct($idCentro, $nombre, $direccion, $email, $telefono, $password)
    {
        $this->idCentro = $idCentro;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->password = $password;

        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = Db::getInstance();
        $this->conection = $dbObj->connection;
    }


    public function getIdCentro()
    {
        return $this->idCentro;
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

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        $this->setCampo($direccion, 'direccion');
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

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        $this->setCampo($telefono, 'telefono');
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        $this->setCampo($password, 'password');
    }

    public function altaCentro($nombre, $direccion, $telefono, $email, $password)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // preparar la consulta con parámetros marcados con signos de interrogación
        $sql = "INSERT INTO centroeducativo (nombre, direccion, email,  telefono,password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conection->prepare($sql);

        // asociar los valores a los parámetros de la consulta
        $stmt->bind_param("sssss", $nombre, $direccion, $email, $telefono,  $hashPassword);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /* Inicio sesion centro */
    public function login($password, $email)
    {
        $sql = "SELECT * FROM `centroeducativo` WHERE `email` = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            return 'false';
        }

        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['centro'] = $row['idCentro'];
            return $row;
        }
    }


    public function close()
    {
        $_SESSION['centro'] = NULL;
        unset($_SESSION['centro']);
    }

    public function cambiarContraseña($nuevaContraseña)
    {
        $hashContraseña = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
        $sql = "UPDATE centroeducativo SET password = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("s", $hashContraseña);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function comprobarEmail($email)
    {
        // Consulta preparada a la base de datos
        $sql = "SELECT * FROM centroeducativo WHERE email = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        /* Si ya existe un email */
        if ($result->num_rows > 0) {
            return false;
        }

        return true;
    }


    public function setCampo($valor, $campo)
    {
        $sql = "UPDATE centroeducativo SET $campo = ? WHERE idCentro = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("si", $valor, $_SESSION['centro']);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al actualizar el campo: " . $stmt->error;
            return false;
        }
    }

    public function eliminarCentro($idCentro)
    {
        $sql = "DELETE FROM centroeducativo WHERE idCentro = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idCentro);
        $stmt->execute();
        $rows = $stmt->affected_rows;

        if ($rows > 0) {
            return true;
        } else {
            throw new Exception("No se pudo eliminar el centro");
        }
    }


    /* Devolver todos los estudiantes que pertenecen a un centro */
    public function getEstudiantesPorCentro()
    {
        $sql = "SELECT e.*, t.*, cf.nombreCiclo AS nombreCiclo
                FROM estudiante e 
                INNER JOIN estudiante_titulacion et ON e.idEstudiante = et.idEstudiante 
                INNER JOIN titulacion t ON et.idTitulacion = t.idTitulacion 
                INNER JOIN cicloformativo cf ON t.idCiclo = cf.idCiclo 
                WHERE cf.idCentro = ?";

        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $_SESSION['centro']);
        $stmt->execute();
        $result = $stmt->get_result();

        $estudiantes = array();
        while ($row = $result->fetch_assoc()) {
            $estudiantes[] = $row;
        }

        return $estudiantes;
    }

    /* Validar titulación de un estudiante */
    public function validarTitulacion($idEstudiante, $idCiclo)
    {
        $fecha_actual = date('Y-m-d');
        $sql = "UPDATE titulacion t
            INNER JOIN estudiante_titulacion et ON t.idTitulacion = et.idTitulacion
            SET t.verificado = 1, t.fecha_verificacion = ?
            WHERE et.idEstudiante = ? AND t.idCiclo = ?";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("sii", $fecha_actual, $idEstudiante, $idCiclo);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    public function getCentroById($idCentro)
    {
        $sql = "SELECT * FROM centroeducativo WHERE idCentro = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idCentro);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) return false;
        $row = $result->fetch_assoc();


        return $row;
    }
}
