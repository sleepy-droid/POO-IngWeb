<?php
require_once "FiguraInterface.php";

abstract class FiguraGeometrica implements FiguraInterface {
    protected string $nombre;

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    abstract public function calcularArea(): float;
    abstract public function calcularPerimetro(): float;
}
?>
