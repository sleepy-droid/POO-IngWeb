<?php
header('Content-Type: application/json');

// Autoload de clases (ajusta si tu estructura cambia)
spl_autoload_register(function($className) {
    $file = __DIR__ . '/../classes/' . $className . '.php';
    if (file_exists($file)) require_once $file;
});

// Leer inputs
$figura = $_POST['figura'] ?? '';
$param1 = isset($_POST['param1']) ? (float) $_POST['param1'] : null;
$param2 = isset($_POST['param2']) ? (float) $_POST['param2'] : null;

// Validaciones básicas
if (!$figura) {
    http_response_code(400);
    echo json_encode(['error' => 'Figura no indicada']);
    exit;
}

try {
    switch ($figura) {
        case 'rectangulo':
            if ($param1 <= 0 || $param2 <= 0) throw new Exception('Base y altura deben ser mayores que 0.');
            $obj = new Rectangulo($param1, $param2);
            break;
        case 'triangulo':
            if ($param1 <= 0 || $param2 <= 0) throw new Exception('Lado y altura deben ser mayores que 0.');
            $obj = new Triangulo($param1, $param2);
            break;
        case 'circulo':
            if ($param1 <= 0) throw new Exception('Radio debe ser mayor que 0.');
            $obj = new Circulo($param1);
            break;
        default:
            throw new Exception('Figura no válida.');
    }

    $area = $obj->calcularArea();
    $perimetro = $obj->calcularPerimetro();

    echo json_encode([
        'ok' => true,
        'nombre' => $obj->getNombre(),
        'area' => $area,
        'perimetro' => $perimetro
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
