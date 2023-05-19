<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();



require_once 'config/config.php';
require_once '../model/db.php';
require_once '../model/Gestionar.php';
require_once '../model/Estudiante.php';
require_once '../model/Empresa.php';
require_once '../model/CentroEducativo.php';
require_once '../model/Oferta.php';


if (!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

$controller_path = 'controller/' . $_GET["controller"] . '.php';

if (!file_exists($controller_path)) $controller_path = 'controller/' . constant("DEFAULT_CONTROLLER") . '.php';

require_once $controller_path;

$controllerName = $_GET["controller"];

$controlador = new $controllerName();

$dataToView = array();
$dataToView  = $controlador->{$_GET["action"]}();

// Leer vistas
require_once 'view/template/header.php';
require_once 'view/' . $controlador->view . '.php';
require_once 'view/template/footer.php';
