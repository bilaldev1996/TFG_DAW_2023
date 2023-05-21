<?php
class CicloFormativo
{
    private $idCiclo;
    private $nombreCiclo;
    private $nivel;
    private $familia;
    private $idCentro;

    private $conection;

    public function __construct($idCiclo, $nombreCiclo, $nivel, $familia, $idCentro)
    {
        $this->idCiclo = $idCiclo;
        $this->nombreCiclo = $nombreCiclo;
        $this->nivel = $nivel;
        $this->familia = $familia;
        $this->idCentro = $idCentro;
        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = Db::getInstance();
        $this->conection = $dbObj->connection;
    }


    public function getIdCiclo()
    {
        return $this->idCiclo;
    }

    public function setIdCiclo($idCiclo)
    {
        $this->idCiclo = $idCiclo;
    }

    public function getNombreCiclo()
    {
        return $this->nombreCiclo;
    }

    public function setNombreCiclo($nombreCiclo)
    {
        $this->nombreCiclo = $nombreCiclo;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    public function getFamilia()
    {
        return $this->familia;
    }

    public function setFamilia($familia)
    {
        $this->familia = $familia;
    }

    public function getIdCentro()
    {
        return $this->idCentro;
    }

    public function setIdCentro($idCentro)
    {
        $this->idCentro = $idCentro;
    }

    /* Crear nuevo ciclo formativo */
    public function nuevoCiclo($nombreCiclo, $nivel, $familia, $idCentro)
    {
        $sql = "INSERT INTO cicloformativo (nombreCiclo,nivel,familia,idCentro) VALUES (?,?,?,?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("sssi", $nombreCiclo, $nivel, $familia, $idCentro);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }

    /* Devolver todos los ciclos que pertencen a un centro */
    public function getCiclosCentro($idCentro)
    {
        $sql = "SELECT DISTINCT * FROM cicloformativo WHERE idCentro = ? ORDER BY nivel ASC";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idCentro);
        $stmt->execute();
        $result = $stmt->get_result();
        $ciclos = array();
        while ($row = $result->fetch_assoc()) {
            $ciclos[] = new CicloFormativo($row['idCiclo'], $row['nombreCiclo'], $row['nivel'], $row['familia'], $row['idCentro']);
        }
        return $ciclos;
    }

    public function actualizarCiclo($idCiclo, $nombre, $nivel, $familia)
    {
        $sql = "UPDATE cicloformativo SET nombreCiclo=?, nivel=?, familia=? WHERE idCiclo=? AND idCentro=?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("sssii", $nombre, $nivel, $familia, $idCiclo, $_SESSION['centro']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }

    public function eliminarCiclo($idCiclo)
    {
        $sql  = "DELETE FROM cicloformativo WHERE idCiclo = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idCiclo);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }
}
