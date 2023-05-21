<?php

class Gestionar
{

    private $conection;
    private array $estudiantes = array();
    private array $empresas = array();
    private array $centros = array();
    private array $ofertas = array();

    public function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = Db::getInstance();
        $this->conection = $dbObj->connection;
    }


    public function login($password, $email)
    {

        $sql = "SELECT * FROM `administrador` WHERE `email` = '$email'";
        $result = $this->conection->query($sql);
        if ($result->num_rows < 1) return false;
        $row = $result->fetch_assoc();


        if (password_verify($password, $row['password'])) {
            // Se crea una sesión para el administrador.
            $_SESSION['admin'] = $row['idAdmin'];
            return true;
        } else {
            return false;
        }
    }

    public function close()
    {
        $_SESSION['admin'] = NULL;
        //session_destroy();
        unset($_SESSION['admin']);
    }

    public function cambiarContraseña($nuevaContraseña)
    {
        $hashContraseña = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
        $sql = "UPDATE administrador SET password = '$hashContraseña'";

        if ($this->conection->query($sql)) {
            //echo "Contraseña actualizada correctamente.";
            return true;
        } else {
            //echo "Error al actualizar la contraseña: " . $this->conection->error;
            return false;
        }
    }

    public function getEstudiantes()
    {
        $sql = "SELECT * FROM estudiante";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->estudiantes[$i] = new Estudiante($row['idEstudiante'], $row['nombre'], $row['apellido1'], $row['apellido2'], $row['email'], $row['password'], $row['curriculum'], $row['estado'], $row['perfil'], $row['imagen'], $row['telefono']);
                $i++;
            }
            return $this->estudiantes;
        }
    }

    public function getEmpresas()
    {
        $sql = "SELECT * FROM empresa";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->empresas[$i] = new Empresa($row['idEmpresa'], $row['nombre'], $row['direccion'], $row['email'], $row['password'], $row['descripcion'], $row['logo'], $row['sitio_web'], $row['CIF'], $row['verificado']);
                $i++;
            }
            return $this->empresas;
        }
    }

    public function getCentrosEducativos()
    {
        $sql = "SELECT * FROM centroeducativo";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->centros[$i] = new CentroEducativo($row['idCentro'], $row['nombre'], $row['direccion'], $row['email'], $row['telefono'], $row['password']);
                $i++;
            }
            return $this->centros;
        }
    }

    public function getOfertas()
    {
        $sql = "SELECT * FROM ofertaempleo ORDER BY fechaPublicacion DESC";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->ofertas[$i] = new Oferta(
                    $row['idOferta'],
                    $row['nombreEmpresa'],
                    $row['fechaPublicacion'],
                    $row['fechaVencimiento'],
                    $row['salario'],
                    $row['requisitos'],
                    $row['titulo'],
                    $row['descripcion'],
                    $row['num_vacantes'],
                    $row['num_inscritos'],
                    $row['idEmpresa']
                );
                $i++;
            }
            return $this->ofertas;
        }
    }


    public function getNumeroRegistros($tabla)
    {
        $stmt = $this->conection->prepare("SELECT COUNT(*) as count FROM $tabla");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }



    public function eliminarRegistro($id, $tabla, $campo)
    {
        $stmt = $this->conection->prepare("DELETE FROM $tabla WHERE $campo = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            throw new Exception("No se pudo eliminar el registro");
        }
    }


    public function getOfertaById($idOferta)
    {
        $stmt = $this->conection->prepare("SELECT * FROM ofertaempleo WHERE idOferta = ?");
        $stmt->bind_param("i", $idOferta);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows < 1) return false;
        $row = $resultado->fetch_assoc();


        return $row;
    }

    public function setNumInscritos($idOferta, $num_inscritos)
    {
        $sql = "UPDATE ofertaempleo SET num_inscritos = ? WHERE idOferta = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("ii", $num_inscritos, $idOferta);
        $stmt->execute();
    }


    public function getNumInscritos($idOferta)
    {
        $stmt = $this->conection->prepare("SELECT * FROM ofertaempleo WHERE idOferta = ?");
        $stmt->bind_param("i", $idOferta);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows < 1) return false;
        $row = $resultado->fetch_assoc();


        return $row['num_inscritos'];
    }

    public function getIdsOfertasInscrito()
    {
        $sql = "SELECT idOferta FROM estudiante_oferta WHERE idEstudiante = ?";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("i", $_SESSION['estudiante']);

        $stmt->execute();
        $result = $stmt->get_result();

        $idsOfertas = array();

        while ($row = $result->fetch_assoc()) {
            $idsOfertas[] = $row['idOferta'];
        }


        return $idsOfertas;
    }

    /* Devolver todos los ciclos formativos */
    public function getCiclosFormativos()
    {
        $stmt = $this->conection->prepare("SELECT idCiclo, nombreCiclo, nivel, descripcion, familia, idCentro FROM cicloformativo");
        $stmt->execute();
        $result = $stmt->get_result();
        $ciclos = array();
        while ($row = $result->fetch_assoc()) {
            $ciclos[] = new CicloFormativo($row['idCiclo'], $row['nombreCiclo'], $row['nivel'], $row['descripcion'], $row['familia'], $row['idCentro']);
        }
        return $ciclos;
    }

    /* Devolver ciclo por id */
    public function getCicloById($idCiclo)
    {
        $stmt = $this->conection->prepare("SELECT * FROM cicloformativo WHERE idCiclo = ?");
        $stmt->bind_param("i", $idCiclo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) return false;
        $row = $result->fetch_assoc();


        return new CicloFormativo($row['idCiclo'], $row['nombreCiclo'], $row['nivel'], $row['descripcion'], $row['familia'], $row['idCentro']);
    }

    public function eliminarTitulacionEstudiante($idEstudiante, $idTitulacion)
    {
        $sql1 = "DELETE FROM estudiante_titulacion WHERE idEstudiante = ? AND idTitulacion = ?";
        $stmt1 = $this->conection->prepare($sql1);
        $stmt1->bind_param("ii", $idEstudiante, $idTitulacion);
        $stmt1->execute();
        $stmt1->close();

        $sql2 = "DELETE FROM titulacion WHERE idTitulacion = ?";
        $stmt2 = $this->conection->prepare($sql2);
        $stmt2->bind_param("i", $idTitulacion);
        $stmt2->execute();
        $stmt2->close();
    }

    public function getCentros()
    {
        $stmt = $this->conection->prepare("SELECT * FROM centroeducativo");
        $stmt->execute();
        $result = $stmt->get_result();
        $centros = array();
        while ($row = $result->fetch_assoc()) {
            $centros[] = new CentroEducativo($row['idCentro'], $row['nombre'], $row['direccion'], $row['email'], $row['telefono'], $row['password']);
        }
        $stmt->close();
        return $centros;
    }

    /* Validar una empresa (administrador) */
    public function verificarEmpresa($idEmpresa, $valor)
    {
        $sql = "UPDATE empresa SET verificado = ? WHERE idEmpresa = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("ii", $valor, $idEmpresa);
        $stmt->execute();
    }

    /* Devolver todos los estudiantes con un perfil público */
    public function getEstudiantesPúblicos()
    {
        $perfil = 'Público';
        $stmt = $this->conection->prepare("SELECT * FROM estudiante WHERE perfil = ?");
        $stmt->bind_param("s", $perfil);
        $stmt->execute();
        $result = $stmt->get_result();
        $estudiantes = array();
        while ($row = $result->fetch_assoc()) {
            $estudiantes[] = new Estudiante($row['idEstudiante'], $row['nombre'], $row['apellido1'], $row['apellido2'], $row['email'], $row['password'], $row['curriculum'], $row['estado'], $row['perfil'], $row['imagen'], $row['telefono']);
        }
        return $estudiantes;
    }
}
