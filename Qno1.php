<?php
interface Vehicle {
    public function startEngine();
    public function stopEngine();
}

class Car implements Vehicle {
    private $make, $model, $year;

    public function __construct($make = "", $model = "", $year = 0) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    public function start() {
        echo "Car started.<br>";
    }

    public function startEngine() {
        echo "Car engine started.<br>";
    }

    public function stopEngine() {
        echo "Car engine stopped.<br>";
    }

    public function displayInfo() {
        echo "Make: {$this->make}<br>";
        echo "Model: {$this->model}<br>";
        echo "Year: {$this->year}<br>";
    }

    public function getMake() { return $this->make; }
    public function setMake($v) { $this->make = $v; }
    public function getModel() { return $this->model; }
    public function setModel($v) { $this->model = $v; }
    public function getYear() { return $this->year; }
    public function setYear($v) { $this->year = $v; }

    public function getDescription() {
        return "This is a {$this->make} {$this->model} manufactured in {$this->year}.";
    }
}

class ElectricCar extends Car {
    private $batteryCapacity;

    public function __construct($make, $model, $year, $batteryCapacity) {
        parent::__construct($make, $model, $year);
        $this->batteryCapacity = $batteryCapacity;
    }

    public function charge() {
        echo "Electric car is charging.<br>";
    }

    public function getDescription() {
        return "This is an electric {$this->getMake()} {$this->getModel()} ({$this->getYear()}) with a {$this->batteryCapacity} kWh battery.";
    }
}

$car = new Car("BMW", "M4", 2025);
$car->start();
$car->displayInfo();
echo $car->getDescription() . "<br>";
$car->startEngine();
$car->stopEngine();

echo "<hr>";

$electricCar = new ElectricCar("Depal", "Model 4", 2025, 80);
$electricCar->start();
$electricCar->charge();
echo $electricCar->getDescription() . "<br>";
$electricCar->startEngine();
$electricCar->stopEngine();
?>