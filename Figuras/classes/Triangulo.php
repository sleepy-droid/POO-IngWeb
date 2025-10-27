<?php
require_once "FiguraGeometrica.php";

class Triangulo extends FiguraGeometrica {
    private float $lado;
    private float $altura;

    public function __construct(float $lado, float $altura) {
        parent::__construct("Triángulo");
        $this->lado = $lado;
        $this->altura = $altura;
    }

    public function calcularArea(): float {
        return ($this->lado * $this->altura) / 2;
    }

    public function calcularPerimetro(): float {
        return 3 * $this->lado;
    }
}
?>
