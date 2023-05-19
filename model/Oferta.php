<?php
class Oferta
{
    private $idOferta;
    private $nombreEmpresa;
    private $fechaPublicacion;
    private $fechaVencimiento;
    private $salario;
    private $requisitos;
    private $titulo;
    private $descripcion;
    private $num_vacantes;
    private $num_inscritos;
    private $idEmpresa;

    private $conection;

    public function __construct($idOferta, $nombreEmpresa, $fechaPublicacion, $fechaVencimiento, $salario, $requisitos, $titulo, $descripcion, $num_vacantes, $num_inscritos, $idEmpresa)
    {
        $this->idOferta = $idOferta;
        $this->nombreEmpresa = $nombreEmpresa;
        $this->fechaPublicacion = $fechaPublicacion;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->salario = $salario;
        $this->requisitos = $requisitos;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->num_vacantes = $num_vacantes;
        $this->num_inscritos = $num_inscritos;
        $this->idEmpresa = $idEmpresa;

        $this->getConection();
    }


    public function getConection()
    {
        $dbObj = Db::getInstance();
        $this->conection = $dbObj->connection;
    }



    public function getIdOferta()
    {
        return $this->idOferta;
    }

    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }

    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function getRequisitos()
    {
        return $this->requisitos;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getNumVacantes()
    {
        return $this->num_vacantes;
    }

    public function getNumInscritos()
    {
        return $this->num_inscritos;
    }

    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function setNombreEmpresa($nombreEmpresa, $idOferta)
    {
        $this->nombreEmpresa = $nombreEmpresa;
        $this->setCampo($nombreEmpresa, 'nombreEmpresa', $idOferta);
    }

    public function setFechaPublicacion($fechaPublicacion, $idOferta)
    {
        $this->fechaPublicacion = $fechaPublicacion;
        $this->setCampo($fechaPublicacion, 'fechaPublicacion', $idOferta);
    }


    public function setFechaVencimiento($fechaVencimiento, $idOferta)
    {
        $this->fechaVencimiento = $fechaVencimiento;
        $this->setCampo($fechaVencimiento, 'fechaVencimiento', $idOferta);
    }

    public function setSalario($salario, $idOferta)
    {
        $this->salario = $salario;
        $this->setCampo($salario, 'salario', $idOferta);
    }

    public function setRequisitos($requisitos, $idOferta)
    {
        $this->requisitos = $requisitos;
        $this->setCampo($requisitos, 'requisitos', $idOferta);
    }

    public function setTitulo($titulo, $idOferta)
    {
        $this->titulo = $titulo;
        $this->setCampo($titulo, 'titulo', $idOferta);
    }

    public function setDescripcion($descripcion, $idOferta)
    {
        $this->descripcion = $descripcion;
        $this->setCampo($descripcion, 'descripcion', $idOferta);
    }

    public function setNumVacantes($num_vacantes, $idOferta)
    {
        $this->num_vacantes = $num_vacantes;
        $this->setCampo($num_vacantes, 'num_vacantes', $idOferta);
    }

    public function setNumInscritos($num_inscritos, $idOferta)
    {
        $this->num_inscritos = $num_inscritos;
        $this->setCampo($num_inscritos, 'num_inscritos', $idOferta);
    }

    public function setCampo($valor, $campo, $idOferta)
    {
        $sql = "UPDATE ofertaempleo SET $campo = ? WHERE idOferta = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("si", $valor, $idOferta);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al actualizar el campo: " . $stmt->error;
            return false;
        }
    }

    public function publicarOfertaEmpleo($nombre, $titulo, $descripcion, $fechaVencimiento, $fechaPublicacion, $requisitos, $numeroVacantes, $salario, $numeroInscritos, $idEmpresa)
    {
        $sql = "INSERT INTO ofertaempleo (nombreEmpresa, fechaPublicacion, fechaVencimiento, salario, requisitos, titulo, descripcion, num_vacantes, num_inscritos,idEmpresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("sssisssiii", $nombre, $fechaPublicacion, $fechaVencimiento, $salario, $requisitos, $titulo, $descripcion, $numeroVacantes, $numeroInscritos, $idEmpresa);

        $stmt->execute();
    }



    public function eliminarOferta($idOferta)
    {
        $sql = "DELETE FROM ofertaempleo WHERE idOferta = $idOferta";
        $result = $this->conection->query($sql);

        if ($result) {
            return true;
        } else {
            throw new Exception("No se pudo eliminar el estudiante");
        }
    }


    public function inscribirseOferta($idOferta)
    {
        $fecha_envio = date("Y-m-d");
        $estado_candidatura = 'Enviada';
        $sql = "INSERT INTO estudiante_oferta (idEstudiante, idOferta, fechaEnvio, estadoCandidatura) VALUES (?, ?, ?, ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("iiss", $_SESSION['estudiante'], $idOferta, $fecha_envio, $estado_candidatura);
        $stmt->execute();
    }

    public function estadoCandidaturaEstudiante($idOferta, $estado)
    {
        $sql = "SELECT * FROM estudiante WHERE idEstudiante IN (SELECT idEstudiante FROM estudiante_oferta WHERE idOferta = ? AND estadoCandidatura = ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("is", $idOferta, $estado);

        try {
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows < 1) return false;

            $rows = array();

            while ($row = $resultado->fetch_assoc()) {
                $rows[] = new Estudiante($row['idEstudiante'], $row['nombre'], $row['apellido1'], $row['apellido2'], $row['email'], $row['password'], $row['curriculum'], $row['estado'], $row['perfil'], $row['imagen'], $row['telefono']);
            }

            return $rows;
        } catch (Exception $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function estudiantesInscritos($idOferta)
    {
        $sql = "SELECT * FROM estudiante WHERE idEstudiante IN (SELECT idEstudiante FROM estudiante_oferta WHERE idOferta = ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idOferta);

        try {
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows < 1) return false;

            $rows = array();

            while ($row = $resultado->fetch_assoc()) {
                $rows[] = new Estudiante($row['idEstudiante'], $row['nombre'], $row['apellido1'], $row['apellido2'], $row['email'], $row['password'], $row['curriculum'], $row['estado'], $row['perfil'], $row['imagen'], $row['telefono']);
            }

            return $rows;
        } catch (Exception $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function getFechaEnvio($idOferta)
    {
        $sql = "SELECT fechaEnvio FROM `estudiante_oferta` WHERE idOferta = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idOferta);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows < 1) return false;
        $rows  = array();

        while ($row = $resultado->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function getOfertaById($idOferta)
    {
        $sql = "SELECT * FROM ofertaempleo WHERE idOferta = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idOferta);

        try {
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows < 1) return false;


            while ($row = $resultado->fetch_assoc()) {
                return new Oferta($row['idOferta'], $row['nombreEmpresa'], $row['fechaPublicacion'], $row['fechaVencimiento'], $row['salario'], $row['requisitos'], $row['titulo'], $row['descripcion'], $row['num_vacantes'], $row['num_inscritos'], $row['idEmpresa']);
            }
        } catch (Exception $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function cambiarCandidaturaEstudiante($idEstudiante, $idOferta, $estado)
    {
        $sql = "UPDATE estudiante_oferta SET estadoCandidatura = ? WHERE idEstudiante = ? AND idOferta = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("sii", $estado, $idEstudiante, $idOferta);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al actualizar el campo: " . $stmt->error;
            return false;
        }
    }
}
