<?php include '../php/procesar.php'; ?>

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

        <?php if ($error): ?>
            <h2 style="color:red; text-align:center;"><?= $error ?></h2>
            <p style="text-align:center;"><a href="../html/index.html">Regresar</a></p>
        <?php else: ?>
            <p><strong>Números ingresados:</strong> <?= implode(', ', $numeros) ?></p>
            <p><strong>Números primos:</strong> <?= empty($primos) ? 'Ninguno' : implode(', ', $primos) ?></p>
            <p><strong>Sumatoria:</strong> <?= $suma ?></p>
            <p><strong>Cantidad de números:</strong> <?= $cantidad ?></p>
            <a href="../html/index.html"><button>Volver</button></a>
        <?php endif; ?>
    </div>
</body>
</html>
