<?php

$host = 'db5012962707.hosting-data.io';
$db = 'dbs10885835';
$user = 'dbu1360261';
$pass = 'JobsNow2023';


/* Este código ejecuta una consulta para seleccionar todas las filas
distintas de la tabla `ofertaempleo` donde la columna `titulo` contiene el valor del parámetro
`valor_input`. Luego obtiene los resultados y los almacena en un array 'registros', que
se codifica como una cadena JSON utilizando la función `json_encode()` y se imprime en la salida.
Finalmente, cierra la conexión a la base de datos usando la función `mysqli_close()`. */
if (isset($_GET['valor_input'])) {
    $valor_input = $_GET['valor_input'];
    $con = mysqli_connect($host, $user, $pass, $db, 3306);
    if (!$con) {
        die("Fallo en la conexión " . mysqli_connect_error());
    }
    $query = "SELECT DISTINCT * FROM ofertaempleo WHERE titulo LIKE '%$valor_input%'";
    $result = mysqli_query($con, $query);
    $registros = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $registros[] = $row;
    }

    echo json_encode($registros);

    mysqli_close($con);
}
