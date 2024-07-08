<?php
$mensaje = '';
$perimetro = '';
$area = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $largo = filter_input(INPUT_POST, 'largo', FILTER_VALIDATE_FLOAT);
    $ancho = filter_input(INPUT_POST, 'ancho', FILTER_VALIDATE_FLOAT);

    if ($largo !== false && $ancho !== false) {
        if ($largo > 0 && $ancho > 0) {
            $perimetro = 2 * ($largo + $ancho);
            $area = $largo * $ancho;
        } else {
            $mensaje = "El largo y el ancho deben ser números positivos.";
        }
    } else {
        $mensaje = "Por favor, ingrese valores numéricos válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Rectángulo</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 0 auto; padding: 20px; }
        .error { color: red; }
        .result { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Calculadora de Rectángulo</h1>
    <form method="post">
        <div>
            <label for="largo">Largo:</label>
            <input type="number" id="largo" name="largo" step="0.01" required>
        </div>
        <div>
            <label for="ancho">Ancho:</label>
            <input type="number" id="ancho" name="ancho" step="0.01" required>
        </div>
        <div>
            <input type="submit" value="Calcular">
        </div>
    </form>

    <?php
    if ($mensaje) {
        echo "<p class='error'>$mensaje</p>";
    }
    if ($perimetro !== '' && $area !== '') {
        echo "<div class='result'>";
        echo "<p>Perímetro: $perimetro</p>";
        echo "<p>Área: $area</p>";
        echo "</div>";
    }
    ?>
</body>
</html>