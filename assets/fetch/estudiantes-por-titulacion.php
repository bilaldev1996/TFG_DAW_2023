<?php

$host = 'db5012962707.hosting-data.io';
$db = 'dbs10885835';
$user = 'dbu1360261';
$pass = 'JobsNow2023';

/* Devolver todos los estudiantes que tienen una cierta titulación y si está verificada o no. */
if (isset($_GET['titulacion'])) {
    $titulacion = $_GET['titulacion'];
    $verificado = $_GET['verificado'];


    $con = mysqli_connect($host, $user, $pass, $db, 3306);
    if (!$con) {
        die("Fallo en la conexión " . mysqli_connect_error());
    }
    $query = "SELECT estudiante.* FROM estudiante INNER JOIN estudiante_titulacion et ON estudiante.idEstudiante = et.idEstudiante INNER JOIN titulacion ON et.idTitulacion = titulacion.idTitulacion INNER JOIN cicloformativo ON titulacion.idCiclo = cicloformativo.idCiclo INNER JOIN centroeducativo ON cicloformativo.idCentro = centroeducativo.idCentro WHERE cicloformativo.nombreCiclo =  '$titulacion' AND titulacion.verificado = '$verificado'";
    $result = mysqli_query($con, $query);
    $registros = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $registros[] = $row;
    }

    echo json_encode($registros);

    mysqli_close($con);
}
