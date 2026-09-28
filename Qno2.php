<?php
class Bicycle {
    public $brand, $model, $year, $description = "Used bicycle", $weight;

    public function getInfo() {
        return "$this->brand $this->model ($this->year)";
    }

    public function getWeight($kg = false) {
        return $kg ? $this->weight / 1000 . " kg" : $this->weight . " g";
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }
}
$b1 = new Bicycle();
$b1->brand = "Giant";
$b1->model = "Escape 3";
$b1->year = 2021;
$b1->setWeight(10500);
$b2 = new Bicycle();
$b2->brand = "Trek";
$b2->model = "Marlin 5";
$b2->year = 2024;
$b2->setWeight(12500);

echo $b1->getInfo() . "<br>";
echo $b1->description . "<br>";
echo $b1->getWeight() . "<br>";
echo $b1->getWeight(true) . "<br><br>";

echo $b2->getInfo() . "<br>";
echo $b2->description . "<br>";
echo $b2->getWeight() . "<br>";
echo $b2->getWeight(true);
?>