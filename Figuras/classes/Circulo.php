<?php
require_once "FiguraGeometrica.php";

class Circulo extends FiguraGeometrica {
    private float $radio;

    public function __construct(float $radio) {
        parent::__construct("Círculo");
        $this->radio = $radio;
    }

    public function calcularArea(): float {
        return pi() * pow($this->radio, 2);
    }

    public function calcularPerimetro(): float {
        return 2 * pi() * $this->radio;
    }
}
?>
