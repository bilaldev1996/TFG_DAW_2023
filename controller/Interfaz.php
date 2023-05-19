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

    public function home()
    {
        $this->title = 'Plataforma Empleo JobsNow';
        $this->view = 'home';
    }
}
