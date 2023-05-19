<?php
class Empresa
{
    private $idEmpresa;
    private $nombre;
    private $direccion;
    private $email;
    private $password;
    private $descripcion;
    private $logo;
    private $sitio_web;
    private $CIF;
    private $verificado;

    private $conection;

    // Constructor
    public function __construct($idEmpresa, $nombre, $direccion, $email, $password, $descripcion, $logo, $sitio_web, $CIF, $verificado)
    {
        $this->idEmpresa = $idEmpresa;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->password = $password;
        $this->descripcion = $descripcion;
        $this->logo = $logo;
        $this->sitio_web = $sitio_web;
        $this->CIF = $CIF;
        $this->verificado = $verificado;

        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = Db::getInstance();
        $this->conection = $dbObj->connection;
    }


    // Getters
    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function getSitioWeb()
    {
        return $this->sitio_web;
    }

    public function getCIF()
    {
        return $this->CIF;
    }

    public function getVerificado()
    {
        return $this->verificado;
    }

    // Setters
    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        $this->setCampo($nombre, 'nombre');
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        $this->setCampo($direccion, 'direccion');
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->setCampo($email, 'email');
    }

    public function setPassword($password)
    {
        $this->password = $password;
        $this->setCampo($password, 'password');
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        $this->setCampo($descripcion, 'descripcion');
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
        $this->setCampo($logo, 'logo');
    }

    public function setSitioWeb($sitio_web)
    {
        $this->sitio_web = $sitio_web;
        $this->setCampo($sitio_web, 'sitio_web');
    }

    public function setCIF($CIF)
    {
        $this->CIF = $CIF;
        $this->setCampo($CIF, 'CIF');
    }

    public function setVerificado($verificado)
    {
        $this->verificado = $verificado;
        $this->setCampo($verificado, 'verificado');
    }

    public function setCampo($valor, $campo)
    {
        $sql = "UPDATE empresa SET $campo = ? WHERE idEmpresa = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("si", $valor, $_SESSION['empresa']);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al actualizar el campo: " . $stmt->error;
            return false;
        }
    }

    public function eliminarEmpresa($idEmpresa)
    {
        $sql = "DELETE FROM empresa WHERE idEmpresa = $idEmpresa";
        $result = $this->conection->query($sql);

        if ($result) {
            return true;
        } else {
            throw new Exception("No se pudo eliminar a la empresa");
        }
    }

    public function login($password, $email)
    {

        $sql = "SELECT * FROM `empresa` WHERE `email` = '$email'";
        $result = $this->conection->query($sql);
        if ($result->num_rows < 1) return false;
        $row = $result->fetch_assoc();


        if ($row['verificado'] == 0) {
            $_SESSION['verificado'] = $row['verificado'];
            return false;
        }

        if (password_verify($password, $row['password'])) {
            $_SESSION['empresa'] = $row['idEmpresa'];
            return $row;
        } else {
            return false;
        }
    }

    public function close()
    {
        $_SESSION['empresa'] = NULL;
        // session_destroy();
        unset($_SESSION['empresa']);
    }

    public function altaEmpresa($nombre, $email, $password, $descripcion, $logo, $sitio_web, $cif, $direccion)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $verificado = 0;

        // preparar la consulta con parámetros marcados con signos de interrogación
        $sql = "INSERT INTO empresa (nombre, email, password, descripcion, logo, sitio_web, CIF, direccion,verificado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conection, $sql);

        // asociar los valores a los parámetros de la consulta
        mysqli_stmt_bind_param($stmt, "sssssssss", $nombre, $email, $hashPassword, $descripcion, $logo, $sitio_web, $cif, $direccion, $verificado);

        if (mysqli_stmt_execute($stmt)) {

            /* Recoger ultimo id insertado */
            $lastId = mysqli_insert_id($this->conection);

            $nombre_img = $lastId . $logo;

            // preparar la consulta para actualizar los campos de imagen y curriculum
            $sql = "UPDATE empresa SET logo = ? WHERE idEmpresa = ?";
            $stmt = mysqli_prepare($this->conection, $sql);

            // asociar los valores a los parámetros de la consulta
            mysqli_stmt_bind_param($stmt, "si", $nombre_img, $lastId);
            mysqli_stmt_execute($stmt);

            return $lastId;
        } else {
            return false;
        }
    }

    public function comprobarEmail($email)
    {
        // Consulta a la base de datos
        $sql = "SELECT * FROM empresa WHERE email = '$email'";
        $resultado = $this->conection->query($sql);

        /* Si ya existe un email */
        if ($resultado->num_rows > 0) return false;

        return true;
    }

    public function cambiarContraseña($nuevaContraseña)
    {
        $hashContraseña = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
        $sql = "UPDATE empresa SET password = '$hashContraseña'";

        if ($this->conection->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmpresaById($idEmpresa)
    {
        $sql = "SELECT * FROM empresa WHERE idEmpresa = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("i", $idEmpresa);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) return false;
        $row = $result->fetch_assoc();


        return $row;
    }


    public function getOfertasEmpresa()
    {
        $sql = "SELECT * FROM ofertaempleo WHERE idEmpresa = ? ORDER BY fechaPublicacion DESC";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("i", $_SESSION['empresa']);

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows < 1) return false;

        $rows = array();

        while ($row = $resultado->fetch_assoc()) {
            $rows[] = new Oferta($row['idOferta'], $row['nombreEmpresa'], $row['fechaPublicacion'], $row['fechaVencimiento'], $row['salario'], $row['requisitos'], $row['titulo'], $row['descripcion'], $row['num_vacantes'], $row['num_inscritos'], $row['idEmpresa']);
        }


        return $rows;
    }

    public function eliminarCuenta($idEmpresa)
    {
        $sql = "DELETE FROM empresa WHERE idEmpresa = ?";
        $stmt = $this->conection->prepare($sql);

        $stmt->bind_param("i", $idEmpresa);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
