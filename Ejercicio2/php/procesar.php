<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Resultado de la Compra</title> <!-- Título que aparece en la pestaña del navegador -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Enlace a Bootstrap para estilos -->
</head>
<body class="bg-info d-flex align-items-center justify-content-center vh-100"> 

    <div class="container d-flex justify-content-center"> 
        <div class="card border-0 shadow-lg rounded-3 p-4" style="background: linear-gradient(135deg, #f0f8ff, #e0f7fa); max-width: 400px;">
            <div class="card-body">
                <?php
                // Función para validar que el nombre solo contiene letras y espacios
                function validarNombre($nombre) {
                    return preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombre);
                }

                // Función para calcular el total de la compra (precio * cantidad)
                function calcularTotal($precio, $cantidad) {
                    return $precio * $cantidad;
                }

                // Función para calcular el vuelto (pago - total)
                function calcularVuelto($pago, $total) {
                    return $pago - $total;
                }

                // Función para desglosar el vuelto en billetes y monedas
                function desglosarVuelto($vuelto) {
                    if ($vuelto == 0) {
                        return ["No se necesita vuelto."];
                    }

                    $billetes = [100, 50, 20, 10, 5, 1];
                    $monedas = [0.50, 0.25, 0.10, 0.05, 0.01];
                    $desglose = [];

                    // Desglose en billetes
                    foreach ($billetes as $billete) {
                        if ($vuelto >= $billete) {
                            $cantidad = floor($vuelto / $billete); // Calcula cuántos billetes de esa denominación se necesitan
                            if ($cantidad > 0) {
                                $desglose[] = "$cantidad billete" . ($cantidad > 1 ? "s" : "") . " de $$billete";
                            }
                            $vuelto = fmod($vuelto, $billete); // Resta el valor de los billetes dados
                        }
                    }

                    // Desglose en monedas
                    foreach ($monedas as $moneda) {
                        if ($vuelto >= $moneda) {
                            $cantidad = floor($vuelto / $moneda); // Calcula cuántas monedas de esa denominación se necesitan
                            if ($cantidad > 0) {
                                $desglose[] = "$cantidad moneda" . ($cantidad > 1 ? "s" : "") . " de $$moneda";
                            }
                            $vuelto = round(fmod($vuelto, $moneda), 2); // Resta el valor de las monedas dadas
                        }
                    }

                    return $desglose; // Devuelve el desglose completo
                }

                // Si el formulario fue enviado
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nombre = trim($_POST["nombre"]); // Limpia los espacios en blanco del nombre
                    $precio = floatval($_POST["precio"]); // Convierte el precio a tipo float
                    $cantidad = intval($_POST["cantidad"]); // Convierte la cantidad a tipo entero
                    $pago = floatval($_POST["pago"]); // Convierte el pago a tipo float

                    $errores = []; // Array para almacenar posibles errores de validación

                    // Validaciones
                    if (!validarNombre($nombre)) {
                        $errores[] = "El nombre solo debe contener letras y espacios.";
                    }
                    if ($precio <= 0 || $cantidad <= 0 || $pago <= 0) {
                        $errores[] = "Los valores de precio, cantidad y pago deben ser mayores que 0.";
                    }

                    $total = calcularTotal($precio, $cantidad); // Calcula el total de la compra

                    if ($pago < $total) {
                        $errores[] = "El pago del cliente no es suficiente para cubrir el total.";
                    }

                    // Si hay errores, muestra los mensajes de error
                    if (!empty($errores)) {
                        echo "<div class='alert alert-danger'>";
                        echo "<h4 class='alert-heading'>Errores encontrados</h4>";
                        foreach ($errores as $error) {
                            echo "<p>$error</p>";
                        }
                        echo "</div>";
                        echo "<a class='btn btn-primary' href='../html/index.html'>Volver al formulario</a>"; // Botón para regresar
                    } else {
                        // Si no hay errores, calcula el vuelto y muestra el desglose
                        $vuelto = calcularVuelto($pago, $total);
                        $desglose = desglosarVuelto($vuelto);

                        // Muestra el resumen de la compra
                        echo "<h2 class='text-center text-primary mb-4'>Resumen de Compra</h2>";
                        echo "<p><strong>Cliente:</strong> $nombre</p>";
                        echo "<p><strong>Total a Pagar:</strong> $" . number_format($total, 2) . "</p>";
                        echo "<p><strong>Pago Realizado:</strong> $" . number_format($pago, 2) . "</p>";
                        echo "<p><strong>Vuelto:</strong> $" . number_format($vuelto, 2) . "</p>";
                        echo "<h3>Desglose del Vuelto:</h3>";
                        echo "<ul class='list-group'>";
                        foreach ($desglose as $item) {
                            echo "<li class='list-group-item'>$item</li>";
                        }
                        echo "</ul>";
                        echo "<a class='btn btn-success mt-3' href='../html/index.html'>Nueva Compra</a>"; // Botón para realizar una nueva compra
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Script de Bootstrap -->
</body>
</html>
