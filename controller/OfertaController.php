<?php
class OfertaController
{
    public $view;
    public $title;
    public $oferta;
    public $gestionar;
    public $estudiante;


    public function __construct()
    {
        $this->oferta = new Oferta(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $this->estudiante = new Estudiante(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $this->gestionar = new Gestionar();
    }

    /* Ver ofertas de empleo disponibles */
    public function verOfertas()
    {
        if (isset($_SESSION['estudiante'])) {
            $this->view = 'verOfertas';
            $this->title = 'Ofertas';
            return array(
                "estudiante" => $this->estudiante->getEstudianteById($_SESSION['estudiante']),
                "ofertas" => $this->gestionar->getOfertas(),
                'ids' => $this->gestionar->getIdsOfertasInscrito()
            );
        }

        return $this->view = 'accesoEstudiante';
    }

    /*
    * Función que muestra una oferta para un estudiante
     */
    public function verOferta()
    {

        if (isset($_SESSION['estudiante'])) {

            $this->view = 'verOferta';
            $this->title = 'Ver Oferta';
            $idOferta = $_GET['idOferta'];

            return array(
                "estudiante" => $this->estudiante->getEstudianteById($_SESSION['estudiante']),
                "oferta" => $this->gestionar->getOfertaById($idOferta),
                "inscrito" => $this->estudiante->inscrito($idOferta)
            );
        }

        return $this->view = 'accesoEstudiante';
    }

    /* Función para que un estudiante se pueda inscribir en una oferta concreta también actualiza el número de inscritos en una oferta  */
    public function inscribirseOferta()
    {

        if (!isset($_GET['idOferta']) || !is_numeric($_GET['idOferta'])) {
            die('Error: ID de oferta inválido');
        }

        $idOferta = $_GET['idOferta'];

        try {
            $this->oferta->inscribirseOferta($idOferta);

            $numInscritos = $this->gestionar->getNumInscritos($idOferta);

            // Incrementar en uno el número de inscritos
            $numInscritos++;

            // Actualizar el número de inscritos en la base de datos
            $this->gestionar->setNumInscritos($idOferta, $numInscritos);
            $this->view = 'verOferta';
            return $this->verOfertas();
        } catch (Exception $e) {
            header('Location: index.php?controller=OfertaController&action=verOfertas');
            exit();
        }
    }
}
