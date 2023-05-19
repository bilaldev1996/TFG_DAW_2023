<?php
class Titulacion
{
    private $idTitulacion;
    private $verificado;
    private $anioCurso;
    private $fechaVerificacion;
    private $idCiclo;

    private $conection;

    // Constructor
    public function __construct($idTitulacion, $verificado, $anioCurso, $fechaVerificacion, $idCiclo)
    {
        $this->idTitulacion = $idTitulacion;
        $this->verificado = $verificado;
        $this->anioCurso = $anioCurso;
        $this->fechaVerificacion = $fechaVerificacion;
        $this->idCiclo = $idCiclo;
        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = Db::getInstance();
        $this->conection = $dbObj->connection;
    }


    // Getters y Setters
    public function getIdTitulacion()
    {
        return $this->idTitulacion;
    }

    public function setIdTitulacion($idTitulacion)
    {
        $this->idTitulacion = $idTitulacion;
    }

    public function getVerificado()
    {
        return $this->verificado;
    }

    public function setVerificado($verificado)
    {
        $this->verificado = $verificado;
    }

    public function getAnioCurso()
    {
        return $this->anioCurso;
    }

    public function setAnioCurso($anioCurso)
    {
        $this->anioCurso = $anioCurso;
    }

    public function getFechaVerificacion()
    {
        return $this->fechaVerificacion;
    }

    public function setFechaVerificacion($fechaVerificacion)
    {
        $this->fechaVerificacion = $fechaVerificacion;
    }

    public function getIdCiclo()
    {
        return $this->idCiclo;
    }

    public function setIdCiclo($idCiclo)
    {
        $this->idCiclo = $idCiclo;
    }
}
