<?php


$host = 'db5012962707.hosting-data.io';
$db = 'dbs10885835';
$user = 'dbu1360261';
$pass = 'JobsNow2023';

$con = mysqli_connect($host, $user, $pass, $db, 3306);
if (!$con) {
    die("Fallo en la conexión " . mysqli_connect_error());
}

/* Devuelve el nombre de un ciclo formativo de un nivel específico */
if (isset($_POST['nivel'])) {
    $nivel = $_POST['nivel'];


    $sql = "SELECT nombreCiclo,idCiclo FROM cicloformativo WHERE nivel = '$nivel'";
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
