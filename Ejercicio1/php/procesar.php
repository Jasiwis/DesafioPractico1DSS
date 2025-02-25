<?php
include 'funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la entrada del usuario
    $entrada = $_POST['numeros'];

    // Validar que solo se ingresen números y comas (sin caracteres especiales)
    if (!preg_match('/^[0-9, ]+$/', $entrada)) {
        echo "<h2 style='color:red; text-align:center;'>Error: Sólo se permiten números enteros positivos (incluido 0) y comas.</h2>";
        echo "<p style='text-align:center;'><a href='../html/index.html'>Regresar</a></p>";
        exit();
    }

    // Convertir la cadena en un array de números
    $numeros = array_map('intval', explode(',', $entrada));

    // Filtrar los números negativos (si hay)
    $numeros = array_filter($numeros, function($num) {
        return $num >= 0;  // Solo mantener números positivos y 0
    });

    // Obtener los primos, la suma y la cantidad de números
    $primos = obtenerPrimos($numeros);
    $suma = calcularSuma($numeros);
    $cantidad = contarNumeros($numeros);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Resultados</h1>
        <p><strong>Números ingresados:</strong> <?= implode(', ', $numeros) ?></p>
        <p><strong>Números primos:</strong> <?= empty($primos) ? 'Ninguno' : implode(', ', $primos) ?></p>
        <p><strong>Sumatoria:</strong> <?= $suma ?></p>
        <p><strong>Cantidad de números:</strong> <?= $cantidad ?></p>
        <a href="../html/index.html"><button>Volver</button></a>
    </div>
</body>
</html>
