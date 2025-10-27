<?php
require_once "FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica {
    private float $base;
    private float $altura;

    public function __construct(float $base, float $altura) {
        parent::__construct("Rectángulo");
        $this->base = $base;
        $this->altura = $altura;
    }

    public function calcularArea(): float {
        return $this->base * $this->altura;
    }

    public function calcularPerimetro(): float {
        return 2 * ($this->base + $this->altura);
    }
}
?>
