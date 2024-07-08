<?php
// Clase padre Animal
class Animal {
    protected $nombre;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }
}

// Clase hija Gato
class Gato extends Animal {
    public function hacerSonido() {
        return "Miau";
    }
}

// Clase hija Perro
class Perro extends Animal {
    public function hacerSonido() {
        return "Guau";
    }
}

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);

    if ($nombre && $tipo) {
        if ($tipo == 'gato') {
            $animal = new Gato($nombre);
        } elseif ($tipo == 'perro') {
            $animal = new Perro($nombre);
        }

        if (isset($animal)) {
            $mensaje = "El Animal {$animal->getNombre()} hace {$animal->hacerSonido()}.";
        }
    } else {
        $mensaje = "Por favor, ingrese un nombre y seleccione un tipo de animal.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creador de Animales</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 0 auto; padding: 20px; }
        .mensaje { margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Creador de Animales</h1>
    <form method="post">
        <div>
            <label for="nombre">Nombre del animal:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="tipo">Tipo de animal:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Seleccione un tipo</option>
                <option value="gato">Gato</option>
                <option value="perro">Perro</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Crear animal">
        </div>
    </form>

    <?php
    if ($mensaje) {
        echo "<p class='mensaje'>$mensaje</p>";
    }
    ?>
</body>
</html>