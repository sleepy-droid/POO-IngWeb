<?php
// Cargar clases automáticamente
spl_autoload_register(function($className) {
    require_once __DIR__ . "/classes/" . $className . ".php";
});

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $figura = $_POST['figura'] ?? '';
    $param1 = (float) ($_POST['param1'] ?? 0);
    $param2 = (float) ($_POST['param2'] ?? 0);

    switch ($figura) {
        case 'rectangulo':
            $obj = new Rectangulo($param1, $param2);
            break;
        case 'triangulo':
            $obj = new Triangulo($param1, $param2);
            break;
        case 'circulo':
            $obj = new Circulo($param1);
            break;
        default:
            die("Figura no válida.");
    }

    echo "<h2>{$obj->getNombre()}</h2>";
    echo "Área: " . $obj->calcularArea() . "<br>";
    echo "Perímetro: " . $obj->calcularPerimetro() . "<br>";
    echo "<br><a href='views/formulario.php'>Volver</a>";
} else {
    include "views/formulario.php";
}
?>
