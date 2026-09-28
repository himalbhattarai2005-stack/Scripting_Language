<?php
class Product {
    private $description, $quantity, $price;

    public function __construct($description, $quantity, $price) {
        if (!is_string($description)) {
            echo "Error: Description must be a string.<br>";
            $description = "";
        }
        if (!is_numeric($quantity)) {
            echo "Error: Quantity must be a number.<br>";
            $quantity = 0;
        }
        if (!is_numeric($price)) {
            echo "Error: Price must be a number.<br>";
            $price = 0;
        }

        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getDescription() { return $this->description; }
    public function setDescription($v) { $this->description = $v; }
    public function getQuantity() { return $this->quantity; }
    public function setQuantity($v) { $this->quantity = $v; }
    public function getPrice() { return $this->price; }
    public function setPrice($v) { $this->price = $v; }

    public function calculatePrice() {
        return $this->quantity * $this->price;
    }
}

$product = new Product("Laptop", 5, 110000);

echo "Description: " . $product->getDescription() . "<br>";
echo "Quantity: " . $product->getQuantity() . "<br>";
echo "Price: Rs. " . $product->getPrice() . "<br>";
echo "Total Price: Rs. " . $product->calculatePrice() . "<br>";
?>