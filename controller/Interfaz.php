<?php
class Interfaz
{
    public $view;
    public $gestionar;
    public $title;
    public $oferta;


    public function __construct()
    {
    }

    /*
    *Mostrar la página principal de la aplicación
     */
    public function home()
    {
        $this->title = 'Plataforma Empleo JobsNow';
        $this->view = 'home';
    }
}
