<?php
include 'funciones.php'; 

$error = ""; // Variable para almacenar los errores si los hay
$resultado = ""; // Variable para almacenar el resultado del análisis

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica si el formulario ha sido enviado mediante el método POST
    $entrada = $_POST['numeros']; // Obtiene los números ingresados por el usuario

    // Valida que la entrada solo contenga números y comas
    if (!preg_match('/^[0-9, ]+$/', $entrada)) {
        $error = "Error: Sólo se permiten números enteros positivos (incluido 0) y comas."; // Si no es válido, muestra un error
    } else {
        // Convierte la cadena de números en un array de enteros
        $numeros = array_map('intval', explode(',', $entrada));
        // Filtra los números para asegurarse de que sean 0 o mayores
        $numeros = array_filter($numeros, fn($num) => $num >= 0);

        // Llama a las funciones que hacen los cálculos
        $primos = obtenerPrimos($numeros); // Obtiene los números primos de la lista
        $suma = calcularSuma($numeros); // Calcula la suma de los números
        $cantidad = contarNumeros($numeros); // Cuenta la cantidad de números

        // Crea un resumen de los resultados
        $resultado = "
            <div class='alert alert-success text-center'>
                <p><strong>Números ingresados:</strong> " . implode(', ', $numeros) . "</p>
                <p><strong>Números primos:</strong> " . (empty($primos) ? 'Ninguno' : implode(', ', $primos)) . "</p>
                <p><strong>Sumatoria:</strong> $suma</p>
                <p><strong>Cantidad de números:</strong> $cantidad</p>
            </div>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body class="bg-dark d-flex align-items-center justify-content-center vh-100">
    <div class="container"> 
        <div class="card border-0 shadow-lg w-50 mx-auto rounded-4 overflow-hidden"> 
            <div class="card-header bg-primary text-white text-center py-3"> 
                <h2 class="fw-bold mb-0">Resultados del Análisis</h2> 
            </div>
            <div class="card-body p-4 text-center"> <!-- Cuerpo de la tarjeta donde se muestra el resultado o error -->
                <?php if ($error): ?> <!-- Si hay un error, lo muestra -->
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php else: ?> <!-- Si no hay error, muestra el resultado -->
                    <?= $resultado ?>
                <?php endif; ?>
                <a href="../html/index.html" class="btn btn-primary btn-lg rounded-3 mt-3">Volver</a> <!-- Botón para regresar al formulario -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Script de Bootstrap para interactividad -->
</body>
</html>
