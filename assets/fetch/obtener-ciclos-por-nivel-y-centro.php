<?php


$host = 'db5012962707.hosting-data.io';
$db = 'dbs10885835';
$user = 'dbu1360261';
$pass = 'JobsNow2023';

$con = mysqli_connect($host, $user, $pass, $db, 3306);
if (!$con) {
    die("Fallo en la conexión " . mysqli_connect_error());
}

/*  Devuelve el nombre de un ciclo formativo que de un centro y de un nivel específico. */
if (isset($_POST['nivel']) || isset($_POST['centro'])) {

    $nivel = $_POST['nivel'];
    $centro = $_POST['centro'];


    $sql = "SELECT nombreCiclo,idCiclo FROM cicloformativo WHERE nivel = '$nivel' AND idCentro = '$centro'";
    $resultado = mysqli_query($con, $sql);

    // Crear un array con los ciclos formativos obtenidos
    $ciclos = array();
    while ($row = mysqli_fetch_assoc($resultado)) {
        $ciclos[] = array(
            'nombre' => $row['nombreCiclo'],
            'id' => $row['idCiclo']
        );
    }

    echo json_encode($ciclos);
}
