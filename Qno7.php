<?php
interface Shape {
    public function calculateArea();
}

class Circle implements Shape {
    private $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function calculateArea() {
        return pi() * $this->radius ** 2;
    }
}

class Square implements Shape {
    private $side;

    public function __construct($side) {
        $this->side = $side;
    }

    public function calculateArea() {
        return $this->side ** 2;
    }
}

$circle = new Circle(12);
$square = new Square(21);

echo "Circle Area: " . number_format($circle->calculateArea(), 2) . "<br>";
echo "Square Area: " . $square->calculateArea();
?>